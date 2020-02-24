<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\ContestSubmissionRequest;
use App\Submission;
use Exception;
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

        // Crop and fit the image.
        $image = Image::make($file);

        // Get the croppie.js coordinates.
        $cropY = $request->crop[3] - $request->crop[1];
        $cropX = $request->crop[2] - $request->crop[0];

        // Crop the image.
        $image->crop($cropX, $cropY, $request->crop[0], $request->crop[1]);

        // Resize it to the correct dimensions.
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
        $request->user()->can('update', $submission);

        $submission->update([
            'rating' => $request->rating
        ]);

        return response($submission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which owns the submission.
     * @param Submission $submission The submission to delete.
     * @return Response The server response.
     * @throws Exception  Thrown if the submission could not be deleted.
     */
    public function destroy(Request $request, Contest $contest, Submission $submission)
    {
        $request->user()->can('delete', $submission);

        $submission->delete();

        return response('Deleted the submission');
    }
}
