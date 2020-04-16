<?php

namespace App\Jobs;

use App\Contest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\BalanceTransaction;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Payout as StripePayout;

class CreatePlatformPayout implements ShouldQueue
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
     * Handle the event.
     *
     * @throws ApiErrorException If there is a Stripe API error.
     */
    public function handle()
    {
        $amount = $this->calculatePayout($this->contest);

        $this->createContestPayout($this->contest, $amount);
    }

    /**
     * Calculate the payout fee amount.
     *
     * Subtract any occurred Stripe fees from the payout to keep our balance intact.
     *
     * @param Contest $contest The contest to fetch the amount and fees for.
     * @return int The calculated amount that will be available for payout.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function calculatePayout(Contest $contest)
    {
        $transaction = $this->retrieveTransaction($contest);

        return $contest->payment->fee - $transaction->fee;
    }

    /**
     * Retrieve the Stripe balance transaction.
     *
     * @param Contest $contest The contest to fetch the transaction id for.
     * @return BalanceTransaction A Stripe BalanceTransaction containing info about Stripe fees.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function retrieveTransaction(Contest $contest)
    {
        $paymentIntent = PaymentIntent::retrieve($contest->payment->payment_id);

        $transaction = $paymentIntent->charges->data[0]->balance_transaction;

        return BalanceTransaction::retrieve($transaction);
    }

    /**
     * Create a Stripe payout to the platform connected bank account.
     *
     * @param Contest $contest The contest which payment is being paid out.
     * @param int $amount The amount to pay out.
     * @throws ApiErrorException Thrown if the payout could not be created.
     */
    private function createContestPayout(Contest $contest, int $amount)
    {
        $data = [
            'amount' => $amount,
            'currency' => 'eur',
            'metadata' => [
                'contest_id' => $contest->id,
                'payment_intent' => $contest->payment->payment_id,
            ],
            'statement_descriptor' => "contest_id_{$contest->id}",
        ];

        StripePayout::create($data);
    }
}
