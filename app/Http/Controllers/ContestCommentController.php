<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContestCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Contest $contest The contest which we want to fetch comments for.
     * @return Response|View The HTML server response.
     * @throws AuthorizationException Thrown if the user is not allowed to view handover comments.
     */
    public function index(Contest $contest)
    {
        $this->authorize('handover', $contest);

        $contest->load('comments.user');

        return view('contest.comments.index', compact('contest'));
    }
}
