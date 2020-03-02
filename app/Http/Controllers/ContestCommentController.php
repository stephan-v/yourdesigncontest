<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\CommentRequest;
use App\Notifications\Comment as CommentNotification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContestCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest which we want to fetch comments for.
     * @return Response|View The HTML server response.
     * @throws AuthorizationException Thrown if the user is not allowed to view handover comments.
     */
    public function index(Request $request, Contest $contest)
    {
        $this->authorize('handover', $contest);

        $contest->load('comments.user');

        if ($request->ajax()) {
            return response($contest->comments);
        }

        return view('contest.comments.index', compact('contest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Contest $contest The contest to attach the comment to.
     * @param CommentRequest $request The incoming HTTP client request.
     * @return Response The server response.
     */
    public function store(Contest $contest, CommentRequest $request)
    {
        // @TODO add policy.

        $comment = $contest
            ->comments()
            ->create($request->validated())
            ->load('user');

        $user = $request->user();

        // Send out a notification to the winner or contest owner, depending on who comments.
        if ($contest->user->id === $comment->user->id) {
            $user = $contest->winner->user;
        }

        // Notify the other party.
        $user->notify(new CommentNotification($comment, route('contests.show', $contest)));

        return response($comment);
    }
}
