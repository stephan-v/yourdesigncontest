<?php

namespace App\Notifications;

use App\Models\Contest;
use App\Models\User;

class Invitation extends Notification
{
    /**
     * The contests which the designer is invited to.
     *
     * @var Contest $contest
     */
    private $contest;

    /**
     * The optional custom invitation message.
     *
     * @var string $message
     */
    private $message;

    /**
     * Create a new notification instance.
     *
     * @param Contest $contest The contests which the designer is invited to.
     * @param string $message The custom message.
     */
    public function __construct(Contest $contest, ?string $message)
    {
        $this->contest = $contest;
        $this->message = $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param User $user The user which is being notified.
     * @return array The formatted array.
     */
    public function toArray(User $user)
    {
        return [
            'avatar' => $this->contest->user->avatar,
            'message' => $this->message ?? "<b>{$this->contest->user->name}</b> Invited you to join a contest.",
            'route' => route('contests.show', $this->contest),
        ];
    }
}
