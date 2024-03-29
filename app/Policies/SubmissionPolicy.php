<?php

namespace App\Policies;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return boolean Whether the user is allowed to view the user model.
     */
    public function view()
    {
        return true;
    }

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

    /**
     * Determine whether the user can delete the submission.
     *
     * @param User $user The user that is currently logged in.
     * @param Submission $submission The submission that the user wants to delete.
     * @return bool Whether the user is authorized to delete the submission.
     */
    public function delete(User $user, Submission $submission)
    {
        return $user->id === $submission->user->id;
    }

    /**
     * Determine whether the user can restore the submission.
     *
     * @param User $user The user that is currently logged in.
     * @param Submission $submission The submission that the user wants to restore.
     * @return bool Whether the user is authorized to restore the submission.
     */
    public function restore(User $user, Submission $submission)
    {
        return $user->id === $submission->user->id;
    }
}
