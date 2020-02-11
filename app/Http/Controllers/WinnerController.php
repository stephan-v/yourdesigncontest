<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Submission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WinnerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which the submission belongs to.
     * @param Submission $submission The submission to be assigned as winner.
     * @return Response The server response.
     * @throws AuthorizationException If the user is not authorized to create a winning submission.
     */
    public function store(Request $request, Contest $contest, Submission $submission)
    {
        $this->authorize('create', [$contest, $submission]);

        abort_if(
            $contest->winner(),
            Response::HTTP_CONFLICT,
            'A contest winner has already been declared.'
        );

        $submission->winner()->create();

        return response(['redirect' => route('contests.show', $contest)]);
    }
}
