<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Events\ContestWon;
use App\Exceptions\ContestAlreadyWonException;
use App\Models\Submission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class ContestWinnerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Contest $contest The contest which the submission belongs to.
     * @param Submission $submission The submission to be assigned as winner.
     * @return Response The server response.
     * @throws AuthorizationException Thrown if the user is not authorized to create a winner.
     * @throws ContestAlreadyWonException Thrown if the contest already has a winner.
     */
    public function store(Contest $contest, Submission $submission)
    {
        $this->authorize('create', [$contest, $submission]);

        if ($contest->winner) {
            throw new ContestAlreadyWonException();
        }

        $submission->update(['winner' => true]);

        event(new ContestWon($contest));

        return response(['redirect' => route('contests.show', $contest)]);
    }
}
