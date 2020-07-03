<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Payout;
use Illuminate\Http\RedirectResponse;

class ContestPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Contest $contest The contest to create a payout for.
     * @return RedirectResponse The redirect response to redirect back to the previous page.
     */
    public function store(Contest $contest)
    {
        $contest->payout()->create([
            'amount' => $contest->payment->winnings->getAmount(),
            'currency' => $contest->payment->currency,
            'user_id' => $contest->winner->id,
            'status' => Payout::APPROVED,
        ]);

        // @TODO Find out why this is not working.
        alert()->success('Approved','Payment is underway to your designer.');

        return back();
    }
}
