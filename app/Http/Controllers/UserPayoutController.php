<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @return RedirectResponse Redirects back to the contest page.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $user->createPayout();

        return redirect()->route('contests.show', $user);
    }
}
