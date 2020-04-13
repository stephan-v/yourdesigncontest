<?php

namespace App\Jobs;

use App\Contest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\Exception\ApiErrorException;
use Stripe\Transfer;

class TransferFunds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The contest used to transfer funds from.
     *
     * @var Contest $contest
     */
    private $contest;

    /**
     * Create a new job instance.
     *
     * @param Contest $contest THe contest used to transfer funds from.
     */
    public function __construct(Contest $contest)
    {
        $this->contest = $contest;
    }

    /**
     * Execute the job.
     *
     * @throws ApiErrorException Thrown if the request fails.
     * @return void
     */
    public function handle()
    {
        // Transfer Stripe platform funds to the connect account of the winning designer.
        $transfer = Transfer::create([
            'amount' => $this->contest->payment->winnings->getAmount(),
            'currency' => $this->contest->payment->currency,
            'destination' => $this->contest->winner->stripe_connect_id,
        ]);

        // Create the local payout record.
        $this->contest->payout()->create([
            'amount' => $transfer->amount,
            'currency' => $transfer->currency,
            'transfer_id' => $transfer->id,
            'user_id' => $this->contest->winner->id,
        ]);

        CreatePlatformPayout::dispatch($this->contest);
    }
}
