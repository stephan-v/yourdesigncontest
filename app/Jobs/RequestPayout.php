<?php

namespace App\Jobs;

use App\Exceptions\PayoutException;
use App\Payout;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RequestPayout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user to create a payout for.
     *
     * @var User $user
     */
    private $user;

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
     * @throws PayoutException Thrown if the user does not have any pending payouts available.
     */
    public function handle()
    {
        $payouts = $this->user->payouts()->pending()->get();

        if (!count($payouts)) {
            throw PayoutException::noPendingPayouts();
        }

        /** @var Payout $payout */
        foreach ($payouts as $payout) {
            TransferFunds::dispatch($payout->contest);
        }
    }
}
