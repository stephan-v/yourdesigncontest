<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Payout;
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

        alert()->success('Approved','Payment is underway to the winner of your design contest.');

        return back();
    }
}
