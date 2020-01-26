<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\ContestSubmissionRequest;
use App\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContestSubmissionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Contest $contest The contest to show a submissions create view for.
     * @return View The HTML server response.
     */
    public function create(Contest $contest)
    {
        return view('contest.submission.create', compact('contest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Contest $contest The contest which we are storing submissions for.
     * @param ContestSubmissionRequest $request The incoming HTTP client request.
     * @return RedirectResponse Returns a redirect to the contest for which a submission has been added for.
     */
    public function store(Contest $contest, ContestSubmissionRequest $request)
    {
        // @TODO Prevent a store if the contest is finished.

        $path = $request->file('file')->store(
            "submissions/{$contest->id}",
            ['disk' => 'public']
        );

        $contest->submissions()->create([
            'description' => $request->description,
            'user_id' => $request->user()->id,
            'path' => $path,
        ]);

        return redirect()->route('contests.show', ['contest' => $contest]);
    }

    /**
     * Display the specified resource.
     *
     * @param Contest $contest The contest which owns the submission.
     * @param Submission $submission The submission to display.
     * @return View The HTML server response.
     */
    public function show(Contest $contest, Submission $submission)
    {
        $submission->load('comments.user');

        return view('contest.submission.show', compact('contest', 'submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which owns the submission.
     * @param Submission $submission The submission to display.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest, Submission $submission)
    {
        // @TODO Only allow the contest owner to update the rating of submissions belonging to this contest.
        // @TODO create an api route for the update.
        $submission->update([
            'rating' => $request->rating
        ]);

        return response($submission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
