<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Initialize a new controller with an attached policy.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function show(User $user)
    {
        $submissions = $user->submissions()->paginate(12);

        return view('user.show', compact('submissions', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function edit(User $user)
    {
        return view('user.settings', compact('user'));
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

        alert()->success('Success','Your user account has been updated.');

        return redirect()->back();
    }

    /**
     * Display the payout request page.
     *
     * @param User $user The user to create a payout for.
     * @return View The HTML server response.
     * @throws AuthorizationException If the user is not authorized to view the verification page.
     */
    public function payout(User $user)
    {
        $this->authorize('verify', $user);

        $user->with('payouts');

        return view('user.payout');
    }
}
