<?php

namespace App\Observers;

use App\Mail\ContestWinner;
use App\Notifications\VerifyStripeIdentityRequest;
use App\Winner;
use Illuminate\Support\Facades\Mail;

class WinnerObserver
{
    /**
     * Handle the winner "created" event.
     *
     * @param Winner $winner The winner that was created.
     */
    public function created(Winner $winner)
    {
        $user = $winner->submission->user;
        $contest = $winner->submission->contest;

        Mail::to($user)->send(new ContestWinner($contest));

        if ($user->isNotStripeVerified) {
            $user->notify(new VerifyStripeIdentityRequest());
        }
    }
}
