<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can update the model.
     *
     * @param User $user The user that is currently logged in.
     * @param User $model The user that the logged in user wants to update.
     * @return boolean Whether the user is allowed to update the user model.
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user The user that is currently logged in.
     * @param User $model The user that the logged in user wants to verify.
     * @return boolean Whether the user is allowed to verify the user model.
     */
    public function verify(User $user, User $model)
    {
        return $user->id === $model->id;
    }
}
