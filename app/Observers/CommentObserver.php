<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Notifications\DatabaseNotification;

class CommentObserver
{
    /**
     * Handle the comment "deleted" event.
     *
     * @param Comment $comment The comment which was just deleted.
     */
    public function deleted(Comment $comment)
    {
        // Delete the notification about this comment.
        DatabaseNotification::where('type', Comment::class)
            ->where('data->id', $comment->id)
            ->delete();
    }
}
