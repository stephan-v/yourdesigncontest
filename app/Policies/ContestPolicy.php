<?php

namespace App\Policies;

use App\Contest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can pay the contest.
     *
     * @param User $user The user that is currently logged in.
     * @param Contest $contest The contest the user wants to perform a payment for.
     * @return boolean Whether the user is allowed to pay for this contest or not.
     */
    public function pay(User $user, Contest $contest)
    {
        return $user->id === $contest->id;
    }
}
