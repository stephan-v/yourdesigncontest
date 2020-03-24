<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;
use Stripe\Transfer;

class ContestPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest with winner who should receive the contest payout.
     * @return RedirectResponse Redirects back to the contest page.
     * @throws ApiErrorException Thrown if the request fails.
     * @throws AuthorizationException If the user is not the contest owner.
     */
    public function store(Request $request, Contest $contest)
    {
        // @TODO do not allow a payout to be made to a winner that has not set up their connect account.

        $this->authorize('manage', $contest);

        abort_if(
            $contest->payout()->exists(),
            Response::HTTP_CONFLICT,
            'A payout has already been made for this contest.'
        );

        // Retrieve the account of the winner to fetch the default currency.
        $account = Account::retrieve($contest->winner->stripe_connect_id);

        // Create the Stripe transfer.
        $transfer = Transfer::create([
            'amount' => $contest->payment->payout->getAmount(),
            'currency' => $account->default_currency,
            'destination' => $account->id,
        ]);

        // Create the local payout record.
        $contest->payout()->create([
            'amount' => $transfer->amount,
            'currency' => $transfer->currency,
            'payment_id' => $transfer->id,
            'user_id' => $contest->winner->id,
        ]);

        return redirect()->route('contests.show', $contest);
    }
}
