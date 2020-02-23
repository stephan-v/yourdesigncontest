<?php

namespace App\Policies;

use App\Submission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the submission.
     *
     * @param User $user The user that is currently logged in.
     * @param Submission $submission The submission that the user wants to update.
     * @return boolean Whether the user is allowed to update a submission for this contest or not.
     */
    public function update(User $user, Submission $submission)
    {
        // The submission owner or the owner of the contest which the submission belongs to can update a submission.
        return ($user->id === $submission->user->id) || ($user->id === $submission->contest->user->id);
    }
}
