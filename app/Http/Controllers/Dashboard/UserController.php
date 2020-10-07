<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendPasswordNewUser;
use App\Traits\Authorizable;
use App\Traits\MediaHandling;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Throwable;

class UserController extends Controller
{
    use MediaHandling, Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.user.index');
    }

    /**
     * Display a listing of the resource.
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(User::class, function ($query) {
            return $query->leftJoin('model_has_roles as mr', 'mr.model_id', 'users.id')
                ->leftJoin('roles as r', 'r.id', 'mr.role_id')
                ->select('users.*', 'r.name as role')
                ->where('mr.role_id', '!=', 1);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'image|max:2000',
            'name' => 'required|max:250',
            'email' => 'required|email|max:190|unique:users,email,NULL,id,deleted_at,NULL',
            'role_id' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $requestData['password'] = randomPassword();
            if ($request->hasFile('avatar')) {
                $requestData['avatar'] = $this->upload($requestData['avatar'], 'user/avatar/');
            }
            $user = User::create($requestData);
            $user->password = bcrypt($requestData['password']);
            $user->save();
            $role = Role::findById($requestData['role_id']);
            $user->assignRole($role->name);
            $user->notify(new SendPasswordNewUser($user, $requestData['password']));
            if ($stores = data_get($requestData, 'stores', false)) {
                $user->stores()->sync($stores);
                Log::info('Assign CreateUser : ' . $user->stores);
            }
            Log::info('CreateUser : ' . $user);
            Log::info('Assign Role User : ' . $user->roles);
        });

        return redirect()->route('user.index')->with('success', 'User added');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     * @throws Throwable
     */
    public function show(User $user)
    {
        return view('dashboard.user.show', compact('user'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'avatar' => 'image|max:2000',
            'name' => 'required|max:250',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id,deleted_at,NULL',
            'role_id' => 'required',
        ]);
        DB::transaction(function () use ($request, $user) {
            $requestData = $request->all();
            $oldAvatar = $user->avatar;
            if ($request->hasFile('avatar')) {
                $requestData['avatar'] = $this->upload($requestData['avatar'], 'user/avatar/');
            }
            Log::info('Before User Update : ' . $user);
            Log::info('Before Assign Role User Update : ' . $user->roles);
            Log::info('Before  Assign Stores User Update : ' . $user->stores);
            $user->update($requestData);
            $role = Role::findById($requestData['role_id']);
            $user->syncRoles($role->name);
            if ($stores = data_get($requestData, 'stores', false)) {
                $user->stores()->sync($stores);
                Log::info('After Assign Stores User : ' . $user->stores);
            }
            Log::info('After User Update : ' . $user);
            Log::info('After Assign Role User Update : ' . $user->roles);
        });
        return redirect()->route('user.index')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            Log::info('Delete User : ' . $user);
            $user->delete();
        });
        return redirect()->route('user.index')->with('success-sweetalert', 'User deleted');
    }
}
