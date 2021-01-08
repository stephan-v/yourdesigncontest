<?php

namespace App\Policies;

use App\Models\Contest;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WinnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create winners.
     *
     * @param User $user The currently logged in user.
     * @param Contest $contest The contest to which the submission belongs to.
     * @param Submission $submission The submission which is given a winner status.
     * @return bool Whether the user is authorized to create a winning submission.
     */
    public function create(User $user, Contest $contest, Submission $submission)
    {
        $contestBelongsToUser = $user->contests()->where('id', $contest->id)->exists();
        $submissionBelongsToContest = $contest->submissions()->where('id', $submission->id)->exists();

        return $contestBelongsToUser && $submissionBelongsToContest;
    }
}
