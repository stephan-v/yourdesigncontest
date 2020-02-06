<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Submission;
use Illuminate\Http\Response;

class SubmissionCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Submission $submission The submission to attach the comment to.
     * @param CommentRequest $request The incoming HTTP client request.
     * @return Response The server response.
     */
    public function store(Submission $submission, CommentRequest $request)
    {
        $comment = $submission->comments()->create($request->validated());
        $comment->load('user');

        return response($comment);
    }
}
