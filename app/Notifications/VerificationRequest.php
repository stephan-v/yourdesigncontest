<?php

namespace App\Notifications;

class VerificationRequest extends Notification
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
            'message' => 'Please verify your identity for payouts.',
            'route' => route('connect.onboarding'),
        ];
    }
}
