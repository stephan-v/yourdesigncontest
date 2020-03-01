<?php

namespace App\Notifications;

use App\Contest;
use Illuminate\Notifications\Messages\MailMessage;

class SourceFilesAdded extends Notification
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
        return (new MailMessage)
            ->greeting('Hello')
            ->line('The winning designer has added their source files to your contest.')
            ->action('View source files', route('contests.files.index', $this->contest))
            ->line('Thank you for using our application!');
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
            'message' => 'Designer source files have been added to your contest.',
            'route' => route('contests.files.index', $this->contest),
        ];
    }
}
