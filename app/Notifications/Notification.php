<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification as BaseNotification;

abstract class Notification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param User $user The user which is being notified.
     * @return BroadcastMessage
     */
    public function toBroadcast(User $user)
    {
        return new BroadcastMessage([
            'data' => $this->toArray($user),
            'created_at' => now(),
            'read_at' => null
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param User $user The user which is being notified.
     * @return array
     */
    public function toArray(User $user)
    {
        return [];
    }
}
