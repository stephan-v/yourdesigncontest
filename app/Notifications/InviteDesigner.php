<?php

namespace App\Notifications;

use App\Contest;

class InviteDesigner extends Notification
{
    /**
     * The contests which the designer is invited to.
     *
     * @var Contest
     */
    private $contest;

    /**
     * Create a new notification instance.
     *
     * @param Contest $contest The contests which the designer is invited to.
     */
    public function __construct(Contest $contest)
    {
        $this->contest = $contest;
    }

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
     * Get the array representation of the notification.
     *
     * @return array The formatted array.
     */
    public function toArray()
    {
        return [
            'avatar' => $this->contest->user->avatar,
            'message' => "<b>{$this->contest->user->name}</b> Invited you to join his contest.",
            'route' => route('contests.show', $this->contest),
        ];
    }
}
