<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $request->user->update(['stripe_connect_id', $response->stripe_user_id]);

        // @TODO add a flash message to indicate the connect process was a success.
        return redirect()->route('users.show', ['user', $request->user]);
    }
}
