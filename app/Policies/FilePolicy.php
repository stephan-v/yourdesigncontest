<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the comment.
     *
     * @param User $user The user that is currently logged in.
     * @param File $file The file which the user wants to delete.
     * @return bool Whether the user is authorized to delete the comment.
     */
    public function delete(User $user, File $file)
    {
        return $user->id === $file->contest->winner->id;
    }
}
