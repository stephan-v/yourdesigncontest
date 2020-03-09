<?php

namespace App\Notifications;

use App\Contest;

class ContestFinished extends Notification
{
    /**
     * The contests which the designer added source files to.
     *
     * @var Contest $contest
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
     * @return array
     */
    public function toArray()
    {
        return [
            'avatar' => asset('/avatars/user.svg'),
            'message' => 'The contest has ended.',
            'route' => route('contests.show', $this->contest),
        ];
    }
}
