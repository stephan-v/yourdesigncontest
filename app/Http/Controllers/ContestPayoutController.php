<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContestPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param Contest $contest The contest with winner who should receive the contest payout.
     * @throws AuthorizationException If the user is not the contest owner.
     * @return Response The server response.
     */
    public function store(Request $request, Contest $contest)
    {
        $this->authorize('manage', $contest);

        abort_if(
            $contest->payout()->exists(),
            Response::HTTP_CONFLICT,
            'A payout has already been done for this contest.'
        );

        // @TODO check if the user's connect account is validated.
        // @TODO make a request to stripe.
        // @TODO perform this in a job because otherwise there can be no payout if the user's connect acc is not validated?

        $contest->payout()->create([
            'payment_id' => 'this is coming from Stripe.',
            'user_id' => $contest->winner()->submission()->user->id
        ]);

        return response('WIP');
    }
}
