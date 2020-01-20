<?php

namespace App\Policies;

use App\Contest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create a submission to the contest.
     *
     * @param User $user The user that is currently logged in.
     * @param Contest $contest The contest the user wants to enter a submission for.
     * @return boolean Whether the user is allowed to enter a submissoin for this contest or not.
     */
    public function submit(User $user, Contest $contest)
    {
        return !$user->contests->contains($contest->id);
    }
}
