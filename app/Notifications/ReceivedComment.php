<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ReceivedComment extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The comment which was received.
     *
     * @var Comment
     */
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @param Comment $comment The comment which was received.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => $this->toArray($notifiable),
            'created_at' => now(),
            'read_at' => null
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $submission = $this->comment->commentable;

        $route = route('contests.submissions.show', [$submission->contest, $submission], false);

        return [
            'id' => $this->comment->id,
            'message' => "You have a <a href='{$route}'>new comment</a>",
        ];
    }
}
