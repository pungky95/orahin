<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\Authorizable;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class RoleController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.role.index');
    }

    /**
     * Display a listing of the resource.
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(Role::class, function ($query) {
            return $query->where('id', '!=', 1);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.role.create');
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
            'name' => 'required|max:100'
        ]);
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $role = Role::create($requestData);
            Log::info('CreateRole : ' . $role);
        });
        return redirect()->route('role.index')->with('success', 'Role added');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return array|string
     * @throws Throwable
     */
    public function show(Role $role)
    {
        return view('dashboard.role.show', compact('role'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        return view('dashboard.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|max:100'
        ]);
        DB::transaction(function () use ($request, $role) {
            $requestData = $request->all();
            Log::info('Before Update Role Update : ' . $role);
            $role->update($requestData);
            Log::info('Before Update Role Update : ' . $role);
        });
        return redirect()->route('role.index')->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        DB::transaction(function () use ($role) {
            Log::info('Delete Role ' . $role);
            $role->delete();
        });
        return redirect()->route('role.index')->with('success-sweetalert', 'Role deleted');
    }

    public function permissionSetting(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.role.permission', compact('permissions', 'role'));
    }

    public function updatePermissionSetting(Request $request, Role $role)
    {
        $permissions = $request->get('permissions', []);
        Log::info('Before Update Assign Permissions Role : ' . $role->getAllPermissions());
        $role->syncPermissions($permissions);
        Log::info('Before Update Assign Permissions Role : ' . $role->getAllPermissions());
        return redirect()->route('role.permission', ['id' => $role->id])->with('success', 'Role permission updated');
    }
}
