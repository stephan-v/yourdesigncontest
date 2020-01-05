<?php

namespace App\Http\Controllers;

use Stripe\AccountLink;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $link = AccountLink::create([
            'account' => auth()->user()->stripe_id,
            'failure_url' => 'https://example.com/failure',
            'success_url' => 'https://example.com/success',
            'type' => 'custom_account_verification',
            'collect' => 'eventually_due',
        ]);

        dd($link);

        return view('checkout.index');
    }

    /**
     * Start a new session.
     *
     * @return mixed
     * @throws ApiErrorException
     */
    public function session()
    {
        // @TODO change to the production key when needed.
        Stripe::setApiKey(config('services.stripe.key'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'name' => 'T-shirt',
                    'description' => 'Comfortable cotton t-shirt',
                    'images' => ['https://example.com/t-shirt.png'],
                    'amount' => 500,
                    'currency' => 'eur',
                    'quantity' => 1,
                ]
            ],
            'success_url' => 'http://yourdesigncontest.test/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://yourdesigncontest.test/cancel',
        ]);

        return $session;
    }

    public function success()
    {
        return view('checkout.index');
    }
}
