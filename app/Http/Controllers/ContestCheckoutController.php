<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\StripeSessionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class ContestCheckoutController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request The incoming HTTP client request.
     * @return View|Redirector The HTML server response or redirect if the contests data is missing.
     */
    public function create(Request $request)
    {
        // @TODO Add a redirect with a message if the contest has alread been paid for $request->contest->payment.

        // Redirect back to the contest creation when that step has not been completed.
        if (!$request->session()->has('contest')) {
            return redirect('contests');
        }

        $contest = $request->session()->get('contest');

        return view('contest.checkout', compact('contest'));
    }

    /**
     * Start a new Stripe checkout session.
     *
     * @param StripeSessionRequest $request The incoming HTTP client request.
     * @param Contest $contest The contest used for the checkout process.
     * @return string The session ID which is used to redirect the customer to Stripe.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function store(StripeSessionRequest $request, Contest $contest)
    {
        // @TODO Check if the contest belongs to the user.

        abort_if(
            $contest->payment,
            Response::HTTP_CONFLICT,
            'The contest has already been paid for.'
        );

        $data = collect([
            'payment_method_types' => ['card'],
            'payment_intent_data' => [
                'metadata' => [
                    'contest_id' => $contest->id,
                ]
            ],
            'line_items' => [
                [
                    'name' => $request->name,
                    'description' => 'Design contest',
                    'images' => null,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'quantity' => 1,
                ]
            ],
            'success_url' => config('app.url') . '/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => config('app.url') . '/cancel',
        ]);

        // If present use the Stripe customer id, otherwise default to an email for reference.
        if ($stripe_customer_id = $request->user()->stripe_customer_id) {
            $data->put('customer', $stripe_customer_id);
        } else {
            $data->put('customer_email', $request->email);
        }

        $session = Session::create($data->toArray());

        return $session['id'];
    }

    /**
     * The response when a checkout has been completed with success.
     *
     * @param Request $request The incoming HTTP request.
     * @return View The HTML server response.
     * @throws ApiErrorException If the request fails.
     */
    public function success(Request $request)
    {
        $session = Session::retrieve($request->session_id);

        $amount = reset($session->display_items)->amount / 100;
        $email = $session->customer_email;

        $contest = $request->session()->get('contest');

        // Remove the contest from the session.
        $request->session()->forget('contest');

        return view('checkout.success', compact('amount', 'contest', 'email'));
    }
}
