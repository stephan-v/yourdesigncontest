<?php

namespace App\Http\Controllers;

use App\Jobs\RequestPayout;
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
        RequestPayout::dispatch($request->user());

        return redirect()->route('contests.show', $request->user());
    }
}
