<?php

namespace App\Listeners;

use App\Contest;
use App\Events\ContestPayout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Stripe\BalanceTransaction;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Payout as StripePayout;

class PayoutToBankAccount implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ContestPayout $event
     * @throws ApiErrorException If there is a Stripe API error.
     */
    public function handle(ContestPayout $event)
    {
        $amount = $this->calculatePayoutAmount($event->contest);

        $this->createPayout($amount, $event->contest);
    }

    /**
     * Calculate the amount for the bank account.
     *
     * This should be the platform fee percentage minus any incurred Stripe fees.
     *
     * @param Contest $contest The contest to fetch the amount and fees for.
     * @return int The calculated amount that will be available for payout.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function calculatePayoutAmount(Contest $contest)
    {
        $balanceTransaction = $this->retrieveTransactionId($contest);

        // 15% platform fee.
        $platformFee = $contest->payment->payout->multiply(15)->divide(100)->getAmount();

        return $platformFee - $balanceTransaction->fee;
    }

    /**
     * Retrieve the Stripe balance transaction.
     *
     * @param Contest $contest The contest to fetch the transaction id for.
     * @return BalanceTransaction A Stripe BalanceTransaction containing info about Stripe fees.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function retrieveTransactionId(Contest $contest)
    {
        $paymentIntent = PaymentIntent::retrieve($contest->payment->payment_id);

        $transaction = $paymentIntent->charges->data[0]->balance_transaction;

        return BalanceTransaction::retrieve($transaction);
    }

    /**
     * Create a Stripe payout to the platform connected bank account.
     * @param int $amount The amount to pay out.
     * @param Contest $contest The contest which payment is being paid out.
     * @throws ApiErrorException Thrown if the payout could not be created.
     */
    private function createPayout(int $amount, Contest $contest)
    {
        StripePayout::create([
            'amount' => $amount,
            'currency' => 'eur',
            'metadata' => [
                'contest_id' => $contest->id,
                'payment_intent' => $contest->payment->payment_id,
            ],
            'statement_descriptor' => "contest_id_{$contest->id}",
        ]);
    }
}
