<?php

namespace App\Observers;

use App\Comment;
use App\Notifications\ReceivedComment;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param Comment $comment The comment which was just created.
     * @return void
     */
    public function created(Comment $comment)
    {
        $submission = $comment->commentable;
        $user = $submission->user;

        if ($submission->user->id === $comment->user->id) {
            $user = $submission->contest->user;
        }

        return $user->notify(new ReceivedComment($comment));
    }
}
