<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Notifications\Comment as CommentNotification;
use App\Models\Submission;
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
        // @TODO add policy.

        $comment = $submission
            ->comments()
            ->create($request->validated())
            ->load('user');

        // Notify the submission owner.
        $user = $submission->user;

        // If the user owns the submission which is being commented on(reply) we notify the contest owner.
        if ($request->user()->id === $submission->user->id) {
            $user = $submission->contest->user;
        }

        // Notify the user.
        $user->notify(new CommentNotification($comment, route('contests.show', $submission->contest)));

        return response($comment);
    }
}
