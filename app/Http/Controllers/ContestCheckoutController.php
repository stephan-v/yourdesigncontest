<?php

namespace App\Http\Controllers;

use App\Domain\Stripe\Session\SessionData;
use App\Http\Requests\StripeSessionRequest;
use App\Models\Contest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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
        // Redirect back to the contest creation when that step has not been completed.
        if (!$request->session()->has('contest')) {
            return redirect('contests');
        }

        return view('contest.checkout');
    }

    /**
     * Start a new Stripe checkout session.
     *
     * @param StripeSessionRequest $request The incoming HTTP client request.
     * @return string The session ID which is used to redirect the customer to Stripe.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function store(StripeSessionRequest $request)
    {
        $data = $request->session()->get('contest');

        $contest = $request->user()->contests()->create($data);

        // The Stripe checkout session.
        $session = Session::create(
            (new SessionData($request, $contest))->toArray()
        );

        // Create a pending payment.
        $contest->payment()->create([
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_id' => $session['payment_intent'],
            'user_id' => $contest->user->id,
        ]);

        return $session['id'];
    }

    /**
     * The response when a checkout has been completed with success.
     *
     * @param Request $request The incoming HTTP request.
     * @return View The HTML server response.
     * @throws ApiErrorException Thrown if the request fails.
     */
    public function success(Request $request)
    {
        // The Stripe checkout session.
        $session = Session::retrieve($request->session_id);

        $amount = $session->amount_total / 100;
        $contestId = $session->metadata->contest_id;
        $email = $session->customer_details->email;

        $contest = Contest::findOrFail($contestId);
        $contest->load('payment');

        return view('checkout.success', compact('amount', 'contest', 'email'));
    }
}
