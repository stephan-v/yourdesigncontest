<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayoutRequest;
use App\Jobs\CreatePayout;
use Illuminate\Http\RedirectResponse;

class UserPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param PayoutRequest $request The incoming HTTP client request.
     * @return RedirectResponse Redirects back to the contest page.
     */
    public function store(PayoutRequest $request)
    {
        // @TODO only create the payout if the contest has no payout.
        foreach ($request->user()->winnings() as $payment) {
            CreatePayout::dispatch($request, $payment, $request->currency);
        }

        return redirect()->route('users.payout', $request->user());
    }
}
