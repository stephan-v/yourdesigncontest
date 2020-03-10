<?php

namespace App\Listeners;

use App\Events\ContestWon;
use App\Notifications\ContestFinished;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyContestants implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ContestWon $event
     */
    public function handle(ContestWon $event)
    {
        $contest = $event->contest;

        $contestants = $contest->contestants->reject(function(User $contestant) use ($contest) {
            // Notify everyone except the winner since the winner gets a custom notification.
            return $contestant->id === $contest->winner->id;
        });

        Notification::send($contestants, new ContestFinished($contest));
    }
}
