<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function show(User $user)
    {
        $user->load('contests.submissions');

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request The incoming HTTP client request.
     * @param User $user The user to update.
     * @return RedirectResponse Redirect back to the user profile.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->back();
    }
}
