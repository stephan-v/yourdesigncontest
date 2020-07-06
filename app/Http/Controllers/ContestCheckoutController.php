<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Domain\Stripe\LineItems\ContestLineItem;
use App\Domain\Stripe\Session\SessionData;
use App\Http\Requests\StripeSessionRequest;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException If the user is not allowed to enter the checkout process.
     */
    public function store(StripeSessionRequest $request, Contest $contest)
    {
        $this->authorize('checkout', $contest);

        abort_if($contest->payment, Response::HTTP_CONFLICT, 'The contest has already been paid for.');

        // The Stripe checkout session.
        $session = Session::create(
            (new SessionData($request, $contest))->toArray()
        );

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

        $amount = reset($session->display_items)->amount / 100;
        $email = $session->customer_email;

        $contest = $request->session()->get('contest');

        return view('checkout.success', compact('amount', 'contest', 'email'));
    }
}
