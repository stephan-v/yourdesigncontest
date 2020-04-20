<?php

namespace App\Jobs;

use App\Contest;
use App\Domain\Payment\PaymentGateway;
use App\Exceptions\PayoutException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
     * @param PaymentGateway $paymentGateway The payment gateway used to transfer funds.
     * @throws PayoutException Thrown if payout fails.
     */
    public function handle(PaymentGateway $paymentGateway)
    {
        if (!$this->contest->winner->stripe_connect_id) {
            throw PayoutException::missingConnectAccount();
        }

        if ($this->contest->payout()->exists()) {
            throw PayoutException::duplicatePayout();
        }

        // Transfer Stripe platform funds to the connect account of the winning designer.
        $transfer = $paymentGateway->transfer(
            $this->contest->winner,
            $this->contest->payment->winnings->getAmount(),
            $this->contest->payment->currency
        );

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
