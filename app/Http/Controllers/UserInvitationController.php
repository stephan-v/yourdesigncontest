<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Notifications\Invitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserInvitationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request The incoming HTTP client request.
     * @param User $user The user which is being invited to join the contest.
     * @return View The HTML server response.
     */
    public function create(Request $request, User $user)
    {
        $contests = $request->user()->contests;

        return view('contest.invitation.create', ['contests' => $contests, 'invitee' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param User $user The user which is being invited to join the contest.
     * @return Response The server response.
     */
    public function store(Request $request, User $user)
    {
        $contest = Contest::findOrFail($request->contest);
        $message = $request->message;

        $user->notify(new Invitation($contest, $message));

        return response('Invitation has been sent.');
    }
}
