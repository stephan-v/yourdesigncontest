<?php

namespace App\Jobs;

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
     * @return void
     */
    public function handle()
    {
        $payouts = $this->user->payouts()->pending()->get();

        /** @var Payout $payout */
        foreach ($payouts as $payout) {
            // @TODO add a progressbar.
            TransferFunds::dispatch($payout->contest);
        }
    }
}
