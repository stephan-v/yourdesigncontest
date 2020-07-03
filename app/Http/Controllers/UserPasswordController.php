<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserPasswordController extends Controller
{
    /**
     * Initialize a new controller with an attached policy.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function edit(User $user)
    {
        return view('user.password', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserPasswordRequest $request The incoming HTTP client request.
     * @param User $user The user to update.
     * @return RedirectResponse Redirect back to the user profile.
     */
    public function update(UserPasswordRequest $request, User $user)
    {
        $user->update($request->validated());

        alert()->success('Success','Your password has been updated.');

        return back();
    }
}
