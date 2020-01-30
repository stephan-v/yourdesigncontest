<?php

namespace App\Observers;

use App\Mail\ContestWinner;
use App\Winner;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class WinnerObserver
{
    /**
     * Handle the winner "created" event.
     *
     * @param Winner $winner The winner that was created.
     */
    public function created(Winner $winner)
    {
        $user = $winner->submission()->user;
        $contest = $winner->submission()->contest;

        Mail::to($user)->send(new ContestWinner($contest));
    }

    /**
     * Handle the winner "creating" event.
     *
     * @param Winner $winner The winner that is being created.
     */
    public function creating(Winner $winner)
    {
        abort_if(
            $winner->contest->winner()->exists(),
            Response::HTTP_CONFLICT,
            'A contest winner has already been declared.'
        );
    }
}
