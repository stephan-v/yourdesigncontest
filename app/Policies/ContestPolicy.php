<?php

namespace App\Policies;

use App\Contest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create a submission to the contest.
     *
     * @param User $user The user that is currently logged in.
     * @param Contest $contest The contest the user wants to enter a submission for.
     * @return boolean Whether the user is allowed to enter a submission for this contest or not.
     */
    public function submit(User $user, Contest $contest)
    {
        return !$user->contests->contains($contest->id);
    }

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
     * Determine whether the user can continue to the checkout for a given contest.
     *
     * @param User $user The currently logged in user.
     * @param Contest $contest The contest which the user wants to enter a checkout for.
     * @return bool Whether the user is authorized to enter the checkout process.
     */
    public function checkout(User $user, Contest $contest)
    {
        return $user->id === $contest->user->id;
    }

    /**
     * Determine whether the user can view any files.
     *
     * @param User $user The user to test authorization against.
     * @param Contest $contest The contest which source files to display.
     * @return Response Whether or not the user is allowed to view any contest source files.
     */
    public function viewAnySourceFiles(User $user, Contest $contest)
    {
        $owner = $user->contests->contains($contest->id);
        $winner = $user->id === optional($contest->winner)->id;

        // Only contest owners or contest winners are allowed to see source files.
        return ($owner || $winner)
            ? Response::allow()
            : Response::deny('You are not allowed to view the source files of the winning submission');
    }
}
