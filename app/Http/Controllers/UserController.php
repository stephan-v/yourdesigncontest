<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function show(User $user)
    {
        $user->load('contests.submissions');

        // The Stripe dashboard for a connected user.
        $login = Account::createLoginLink($user->stripe_connect_id);

        return view('user.show', ['user' => $user, 'dashboard' => $login->url]);
    }
}
