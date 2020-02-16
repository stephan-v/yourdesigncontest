<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\ContestSubmissionRequest;
use App\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

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
        $file = $request->file('image');

        // @TODO move resize/crop to a service/repository layer.

        // Crop and fit the image.
        $image = Image::make($file);

        $cropY = $request->crop[3] - $request->crop[1];
        $cropX = $request->crop[2] - $request->crop[0];

        $image->crop($cropX, $cropY, $request->crop[0], $request->crop[1]);

        $image->fit(800, 600, function(Constraint $constraint) {
            $constraint->upsize();
        });

        $path = "submissions/{$contest->id}/{$file->hashName()}";

        Storage::disk('public')->put($path, $image->encode());

        $contest->submissions()->create([
            'title' => $request->title,
            'description' => $request->description,
            'path' => $path,
        ]);

        return redirect()->route('contests.show', $contest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response The server response.
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
