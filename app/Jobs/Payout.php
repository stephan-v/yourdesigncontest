<?php

namespace App\Jobs;

use App\Domain\Payout\TransferWise;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Payout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user to create a payout for.
     *
     * @var User $user
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user The user to create a payout for.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param TransferWise $client The TransferWise API client.
     * @return void
     */
    public function handle(TransferWise $client)
    {
        // Step 1: Create a quote.
        $quote = $client->quotes()->create();

        // Step 2: Create a recipient account.
        $account = $client->accounts()->create();

        // Step 3: Create a transfer.
        $transfer = $client->transfers()->create($account['id'], $quote['id']);

        // Step 4: Fund a transfer.
        $client->transfers()->fund($transfer['id']);
    }
}
