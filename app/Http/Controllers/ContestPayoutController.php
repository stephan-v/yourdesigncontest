<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Exceptions\PayoutAlreadyMadeException;
use App\Exceptions\StripeConnectNotFinished;
use App\Jobs\TransferFunds;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContestPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest with winner who should receive the contest payout.
     * @throws AuthorizationException If the user is not the contest owner.
     * @throws StripeConnectNotFinished Thrown if the winner has not set up their connect account.
     * @throws PayoutAlreadyMadeException Thrown if a payout has already been made.
     * @return RedirectResponse Redirects back to the contest page.
     */
    public function store(Request $request, Contest $contest)
    {
        $this->authorize('manage', $contest);

        if (!$contest->winner->stripe_connect_id) {
            throw new StripeConnectNotFinished();
        }

        if ($contest->payout()->exists()) {
            throw new PayoutAlreadyMadeException();
        }

        TransferFunds::dispatch($contest);

        return redirect()->route('contests.show', $contest);
    }
}
