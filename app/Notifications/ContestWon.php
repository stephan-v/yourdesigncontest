<?php

namespace App\Notifications;

use App\Models\Contest;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class ContestWon extends Notification
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
        return ['broadcast', 'database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)->markdown('mail.contest.winner', ['contest' => $this->contest]);
    }

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
            'message' => 'You won a contest!',
            'route' => route('contests.show', $this->contest),
        ];
    }
}
