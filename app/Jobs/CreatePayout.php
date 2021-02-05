<?php

namespace App\Jobs;

use App\Domain\TransferWise\TransferWise;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePayout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The requested payout currency.
     *
     * @var string $currency
     */
    protected $currency;

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
     * @param User $user The user to make the payout to.
     * @param Payment $payment The payment attached to the won contest.
     * @param string $currency The currency used for the payout.
     */
    public function __construct(User $user, Payment $payment, string $currency)
    {
        $this->user = $user;
        $this->payment = $payment;
        $this->currency = $currency;
    }

    /**
     * Execute the job.
     *
     * @param TransferWise $client The TransferWise API client.
     */
    public function handle(TransferWise $client)
    {
        // The payout amount.
        $amount = $this->payment->winnings->getAmount();

        // @TODO Do transferwise conversion of the amount.

        // The local payout record.
        $this->payout = $this->user->payouts()->create([
            'amount' => $amount,
            'currency' => $this->currency,
            'status' => Payout::PENDING,
            'contest_id' => $this->payment->contest_id,
        ]);

        // Step 1: Create a quote. (Set to 'EUR' because USD to another currency is not possible with email accounts)
        $quote = $client->quotes()->create($amount, 'EUR', $this->currency);

        // Step 2: Create a recipient account.
        // @TODO THIS should be a bank account model most likely.
        $account = $client->accounts()->create($this->user, $this->currency);

        // Step 3: Create a transfer.
        $transfer = $client->transfers()->create($account['id'], $quote['id']);

        // Step 4: Fund a transfer.
        $client->transfers()->fund($transfer['id']);

        // Payout was a success.
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
