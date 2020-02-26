<?php

namespace App\Observers;

use App\Comment;
use App\Notifications\Comment as CommentNotification;
use App\User;
use Illuminate\Notifications\DatabaseNotification;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param Comment $comment The comment which was just created.
     */
    public function created(Comment $comment)
    {
        $submission = $comment->commentable;

        /** @var User $user */
        $user = $submission->user;

        // Send out a notification to the submission or contest owner, depending on who comments.
        if ($submission->user->id === $comment->user->id) {
            $user = $submission->contest->user;
        }

        $user->notify(new CommentNotification($comment));
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param Comment $comment The comment which was just deleted.
     */
    public function deleted(Comment $comment)
    {
        // Deleted the notification about this comment.
        DatabaseNotification::where('type', Comment::class)
            ->where('data->id', $comment->id)
            ->delete();
    }
}
