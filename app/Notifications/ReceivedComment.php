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
     * @return array
     */
    public function via()
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @return BroadcastMessage
     */
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'data' => $this->toArray(),
            'created_at' => now(),
            'read_at' => null
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array The formatted array.
     */
    public function toArray()
    {
        return [
            'commentable' => $this->comment->commentable,
            'id' => $this->comment->id,
            'user' => $this->comment->user,
        ];
    }
}
