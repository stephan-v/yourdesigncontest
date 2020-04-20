<?php

namespace App\Listeners;

use App\Events\ContestWon;
use App\Payout;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatePendingPayout implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ContestWon $event
     */
    public function handle(ContestWon $event)
    {
        $contest = $event->contest;

        $contest->payout()->create([
            'amount' => $contest->payment->winnings->getAmount(),
            'currency' => $contest->payment->currency,
            'user_id' => $contest->winner->id,
            'status' => Payout::PENDING,
        ]);
    }
}
