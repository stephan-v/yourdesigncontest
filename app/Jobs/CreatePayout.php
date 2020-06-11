<?php

namespace App\Jobs;

use App\Domain\Payout\TransferWise;
use App\Payment;
use App\Payout;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePayout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The payment attached to the won contest.
     *
     * @var Payment $payment
     */
    protected $payment;

    /**
     * The payout created by this job.
     *
     * @var Payout $payout
     */
    protected $payout;

    /**
     * The user to create a payout for.
     *
     * @var User $user
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param Request $request The request made by the user.
     * @param Payment $payment The payment attached to the won contest.
     */
    public function __construct(Request $request, Payment $payment)
    {
        $this->user = $request->user();
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @param TransferWise $client The TransferWise API client.
     * @return void
     */
    public function handle(TransferWise $client)
    {
        // @TODO fetch the currency from the request.

        $this->payout = $this->user->payouts()->create([
            'amount' => $this->payment->winnings->getAmount(),
            'currency' => $this->payment->currency,
            'status' => Payout::PENDING,
            'contest_id' => $this->payment->contest_id,
        ]);

        // Step 1: Create a quote.
        $quote = $client->quotes()->create(
            $this->payment->winnings->getAmount(),
            $this->payment->currency,
            $this->payout->currency
        );

        // Step 2: Create a recipient account.
        $account = $client->accounts()->create($this->user);

        // Step 3: Create a transfer.
        $transfer = $client->transfers()->create($account['id'], $quote['id']);

        // Step 4: Fund a transfer.
        $client->transfers()->fund($transfer['id']);

        $this->payout->update([
            'status' => Payout::SUCCEEDED
        ]);
    }

    /**
     * The job failed to process.
     */
    public function failed()
    {
        optional($this->payout)->update([
            'status' => Payout::FAILED
        ]);
    }
}
