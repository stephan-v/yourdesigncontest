<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Mail\ContestWinner;
use App\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class WinnerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which the submission belongs to.
     * @param Submission $submission The submission to be assigned as winner.
     * @return RedirectResponse Returns a redirect back to the original location.
     */
    public function store(Request $request, Contest $contest, Submission $submission)
    {
        // @TODO list.
        // Contest should not have a winner yet.
        // Submission needs to belong to contest.
        // Submission can only be assigned winner by owner of the contest.

        abort_if((bool) $contest->winner(), Response::HTTP_CONFLICT, 'A contest winner has already been declared.');

        $submission->winner()->create();

        Mail::to($submission->user)->send(new ContestWinner($contest));

        return redirect()->route('contests.show', ['contest' => $contest]);
    }
}
