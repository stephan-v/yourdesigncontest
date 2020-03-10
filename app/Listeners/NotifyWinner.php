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
        // @TODO change this since it is expected for a winner to be a user already.
        $user = $event->contest->winner->user;

        $user->notify(new ContestWonNotification($event->contest));

        // Send out a verification request if the user is not verified yet.
        if ($user->isNotStripeVerified) {
            $user->notify(new VerificationRequest());
        }
    }
}
