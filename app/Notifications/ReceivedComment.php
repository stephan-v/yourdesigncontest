<?php

namespace App\Notifications;

use App\Comment;

class ReceivedComment extends Notification
{
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
     * Get the array representation of the notification.
     *
     * @return array The formatted array.
     */
    public function toArray()
    {
        return [
            'avatar' => $this->comment->user->avatar,
            'message' => "<b>{$this->comment->user->name}</b> commented on your submission.",
            'route' => route('contests.show', $this->comment->commentable),
        ];
    }
}
