<?php

namespace App\Notifications;

use App\Models\Comment as CommentModel;
use App\Models\User;

class Comment extends Notification
{
    /**
     * The comment which was received.
     *
     * @var CommentModel
     */
    private $comment;

    /**
     * The route which the notification relates to.
     *
     * @var $route
     */
    private $route;

    /**
     * Create a new notification instance.
     *
     * @param CommentModel $comment The comment which was received.
     * @param string $route The route which the notification relates to.
     */
    public function __construct(CommentModel $comment, string $route)
    {
        $this->comment = $comment;
        $this->route = $route;
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
            'avatar' => $this->comment->user->avatar,
            'message' => "<b>{$this->comment->user->name}</b> commented.",
            'route' => $this->route,
        ];
    }
}
