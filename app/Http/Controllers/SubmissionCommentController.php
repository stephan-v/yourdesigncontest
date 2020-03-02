<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Notifications\Comment as CommentNotification;
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
        // @TODO add policy.

        $comment = $submission
            ->comments()
            ->create($request->validated())
            ->load('user');

        $user = $request->user();

        // Send out a notification to the submission or contest owner, depending on who comments.
        if ($submission->user->id === $comment->user->id) {
            $user = $submission->contest->user;
        }

        // Notify the other party.
        $user->notify(new CommentNotification($comment, route('contests.show', $submission->contest)));

        return response($comment);
    }
}
