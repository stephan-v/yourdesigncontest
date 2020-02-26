<?php

namespace App\Notifications;

use App\Contest;

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
            'message' => $this->message ?? "<b>{$this->contest->user->name}</b> Invited you to join his contest.",
            'route' => route('contests.show', $this->contest),
        ];
    }
}
