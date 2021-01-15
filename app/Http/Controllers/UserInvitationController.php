<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Notifications\Invitation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;

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
     * @return RedirectResponse Response to redirect back to the user profile.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'contest_id' => ['required', 'exists:contests,id'],
            'message' => ['nullable', 'string'],
        ]);

        $contest = Contest::findOrFail($request->contest_id);
        $message = $request->message;

        $user->notify(new Invitation($contest, $message));

        alert()->success('Success','Invitation has been sent.');

        return redirect()->route('users.show', $user);
    }
}
