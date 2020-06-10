<?php

namespace App\Http\Controllers;

use App\Jobs\CreatePayout;
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
        // @TODO only create the payout if the contest has not payout.
        foreach ($request->user()->winnings() as $payment) {
            CreatePayout::dispatch($request->user(), $payment);
        }

        return redirect()->route('contests.show', $request->user());
    }
}
