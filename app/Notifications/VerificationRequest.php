<?php

namespace App\Notifications;

use App\User;

class VerificationRequest extends Notification
{
    /**
     * Get the array representation of the notification.
     *
     * @param User $user The user which is being notified.
     * @return array
     */
    public function toArray(User $user)
    {
        return [
            'avatar' => $user->avatar,
            'message' => 'Please verify your identity for payouts.',
            'route' => '',
        ];
    }
}
