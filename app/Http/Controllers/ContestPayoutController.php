<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Exceptions\PayoutException;
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
     * @throws PayoutException Thrown if payout fails.
     * @return RedirectResponse Redirects back to the contest page.
     */
    public function store(Request $request, Contest $contest)
    {
        // Request a payout.
        $this->authorize('manage', $contest);

        if (!$contest->winner->stripe_connect_id) {
            throw PayoutException::missingConnectAccount();
        }

        if ($contest->payout()->exists()) {
            throw PayoutException::duplicatePayout();
        }

        TransferFunds::dispatch($contest);

        return redirect()->route('contests.show', $contest);
    }
}
