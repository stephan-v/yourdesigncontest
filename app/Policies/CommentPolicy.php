<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param User $user The user that is currently logged in.
     * @param Comment $comment The comment which the user wants to update.
     * @return bool Whether the user is authorized to update the comment.
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user-id;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param User $user The user that is currently logged in.
     * @param Comment $comment The comment which the user wants to delete.
     * @return bool Whether the user is authorized to delete the comment.
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user-id;
    }
}
