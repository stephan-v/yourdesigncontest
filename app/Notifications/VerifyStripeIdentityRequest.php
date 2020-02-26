<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class VerifyStripeIdentityRequest extends Notification
{
    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'avatar' => asset('/avatars/user.svg'),
            'message' => 'Please your identity for payouts.',
            'route' => route('connect.onboarding'),
        ];
    }
}
