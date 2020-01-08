<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripeSessionRequest;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    /**
     * Start a new session.
     *
     * @param StripeSessionRequest $request The incoming HTTP request.
     * @return string The session ID which is used to redirect the customer to Stripe.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function store(StripeSessionRequest $request)
    {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'name' => $request->name,
                    'description' => $request->name,
                    'images' => [
                        'https://example.com/t-shirt.png'
                    ],
                    'amount' => ($request->amount * 100),
                    'currency' => 'eur',
                    'quantity' => 1,
                ]
            ],
            'success_url' => config('app.url') . '/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => config('app.url') . '/cancel',
        ]);

        return $session['id'];
    }

    /**
     * The response when a checkout has been completed with success.
     */
    public function success()
    {
        return view('checkout.success');
    }
}
