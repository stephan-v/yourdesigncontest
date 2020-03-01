<?php

namespace App\Observers;

use App\Notifications\ContestWon;
use App\Notifications\VerificationRequest;
use App\Winner;

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

        $user->notify(new ContestWon($contest));

        if ($user->isNotStripeVerified) {
            $user->notify(new VerificationRequest());
        }
    }
}
