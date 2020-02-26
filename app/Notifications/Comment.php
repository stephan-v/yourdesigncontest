<?php

namespace App\Notifications;

use App\Comment as CommentModel;

class Comment extends Notification
{
    /**
     * The comment which was received.
     *
     * @var CommentModel
     */
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @param CommentModel $comment The comment which was received.
     */
    public function __construct(CommentModel $comment)
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
            'route' => route('contests.show', $this->comment->commentable->contest),
        ];
    }
}
