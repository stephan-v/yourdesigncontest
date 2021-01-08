<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Http\Requests\ContestSubmissionRequest;
use App\Models\Submission;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
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

        $fileName = $file->hashName();

        $path = "contests/{$contest->id}/submissions/{$fileName}";

        Storage::disk('public')->put($path, $image->encode());

        $contest->submissions()->create([
            'title' => $request->title,
            'description' => $request->description,
            'filename' => $fileName,
            'user_id' => $request->user()->id,
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
     * @throws AuthorizationException If the user is not authorized to perform the current action.
     */
    public function update(Request $request, Contest $contest, Submission $submission)
    {
        $this->authorize('update', $submission);

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
     * @throws Exception Thrown if the submission could not be deleted.
     */
    public function destroy(Request $request, Contest $contest, Submission $submission)
    {
        $this->authorize('delete', $submission);

        if ($submission->winner) {
            throw new Exception('You can not delete a winning submission');
        }

        $submission->delete();

        return response('The submission has been deleted');
    }

    /**
     * Restore the specified resource.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which owns the submission.
     * @param int $submissionId The id of the submission to restore.
     * @return Response The server response.
     * @throws AuthorizationException If the user is not authorized to perform the current action.
     */
    public function restore(Request $request, Contest $contest, int $submissionId)
    {
        $submission = Submission::onlyTrashed()->findOrFail($submissionId);

        $this->authorize('restore', $submission);

        $submission->restore();

        return response('The submission has been restored');
    }
}
