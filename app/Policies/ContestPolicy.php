<?php

namespace App\Policies;

use App\Models\Contest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create a contest.
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user can manage the contest.
     *
     * @param User $user The user that is currently logged in.
     * @param Contest $contest The contest the user wants to enter a submission for.
     * @return boolean Whether the user is allowed to manage this contest or not.
     */
    public function manage(User $user, Contest $contest)
    {
        return $user->id === $contest->user->id;
    }

    /**
     * Determine whether the user can view any files.
     *
     * @param User $user The user to test authorization against.
     * @param Contest $contest The contest which source files to display.
     * @return Bool Whether or not the user is allowed to view any contest source files.
     */
    public function handover(User $user, Contest $contest)
    {
        $owner = $user->contests->contains($contest->id);
        $winner = $user->id === optional($contest->winner)->id;

        // Only contest owners or contest winners are allowed to participate in a handover.
        return ($owner || $winner);
    }
}
