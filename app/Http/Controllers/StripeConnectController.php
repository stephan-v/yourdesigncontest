<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        // @TODO add a flash message to indicate the connect process was a success.
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

    /**
     * Generate the Stripe connect onboarding URI.
     *
     * @param Request $request The incoming HTTP server request.
     * @return string The generated URI.
     */
    public function onboarding(Request $request): string
    {
        $route = route('users.show', $request->user());

        $params = http_build_query([
            'client_id' => config('services.stripe.connect.client_id'),
            'redirect_uri' => route('connect.complete'),
            'stripe_user[business_type]' => 'individual',
            'stripe_user[email]' => $request->user()->email,
            'stripe_user[url]' => Str::replaceFirst('.test', '.com', $route),
            'suggested_capabilities[]' => 'transfers',
            'state' => 'test',
        ]);

        $url = config('services.stripe.connect.uri') . $params;

        return redirect()->away($url);
    }
}
