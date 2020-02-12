<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Submission;
use Illuminate\Http\Response;

class SubmissionCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Submission $submission The submission to fetch comments for.
     * @return Response The server response.
     */
    public function index(Submission $submission)
    {
        $submission->load('comments.user');

        return response($submission->comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Submission $submission The submission to attach the comment to.
     * @param CommentRequest $request The incoming HTTP client request.
     * @return Response The server response.
     */
    public function store(Submission $submission, CommentRequest $request)
    {
        $comment = $submission
            ->comments()
            ->create($request->validated())
            ->load('user');

        return response($comment);
    }
}
