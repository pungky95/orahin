<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use App\Traits\Authorizable;
use App\Traits\MediaHandling;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use MediaHandling, Authorizable;

    /**
     * Display the specified resource.
     *
     * @return Factory|View
     */
    public function personalInformation()
    {
        return view('dashboard.user.personal_information');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updatePersonalInformation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:250',
            'email' => 'required|max:191|email|unique:users,email,' . Auth::user()->id . ',id,deleted_at,NULL',
        ]);
        $requestData = $request->all();
        DB::transaction(function () use ($requestData, $request) {
            $user = User::findOrFail(Auth::user()->id);
            $user->update($requestData);
        });
        return redirect()->route('personal-information')->with('success', 'Personal information has been updated');
    }

    /**
     * Display the specified resource.
     * @return Factory|View
     */
    public function changePassword()
    {
        return view('dashboard.user.change_password');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateChangePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);
        $requestData = $request->all();
        $user = User::find(Auth::user()->id);
        if (Hash::check($requestData['current_password'], $user->password)) {
            DB::transaction(function () use ($requestData, $user) {
                $user->password = bcrypt($requestData['new_password']);
                $user->save();
            });
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        return redirect()->route('change-password')->with('success', 'Password has been changed');
    }
}
