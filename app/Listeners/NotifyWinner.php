<?php

namespace App\Listeners;

use App\Events\ContestWon;
use App\Notifications\ContestWon as ContestWonNotification;
use App\Notifications\VerificationRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyWinner implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ContestWon $event
     */
    public function handle(ContestWon $event)
    {
        $user = $event->contest->winner;

        $user->notify(new ContestWonNotification($event->contest));

        // Send out a verification request if the user is not verified yet.
        if ($user->isNotStripeVerified) {
            $user->notify(new VerificationRequest());
        }
    }
}
