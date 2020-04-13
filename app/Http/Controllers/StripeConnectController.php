<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\OAuth\OAuthErrorException;
use Stripe\OAuth;

class StripeConnectController extends Controller
{
    /**
     * Complete the Stripe connect registration.
     *
     * @param Request $request The incoming HTTP server request.
     * @return RedirectResponse The redirect after completing the connect onboarding.
     * @throws OAuthErrorException Thrown if there is an OAuth error.
     */
    public function complete(Request $request)
    {
        $response = OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $request->code,
        ]);

        $request->user()->update(['stripe_connect_id' => $response->stripe_user_id]);

        // @TODO clear all notifications about validation.

        alert()->success('Success','You are ready to receive payments.');

        return redirect()->route('users.show', $request->user());
    }

    /**
     * Generate the URI to a Stripe connect dashboard.
     *
     * @param Request $request The incoming HTTP server request.
     * @return string The url to redirect the user to.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function dashboard(Request $request)
    {
        $id = $request->user()->stripe_connect_id;
        $dashboard = Account::createLoginLink($id);

        return redirect()->away($dashboard->url);
    }
}
