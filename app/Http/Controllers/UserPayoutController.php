<?php

namespace App\Http\Controllers;

use App\Domain\Payout\TransferWise;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserPayoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The incoming HTTP client request.
     * @param TransferWise $client The TransferWise API client.
     * @return RedirectResponse Redirects back to the contest page.
     */
    public function store(Request $request, TransferWise $client)
    {
        $user = $request->user();

        // Step 1: Create a quote.
        $quote = $client->quotes()->create();

        // Step 2: Create a recipient account.
        $account = $client->accounts()->create();

        // Step 3: Create a transfer.
        $transfer = $client->transfers()->create($account['id'], $quote['id']);

        // Step 4: Fund a transfer.
        $client->transfers()->fund($transfer['id']);

        return redirect()->route('contests.show', $user);
    }
}
