<?php

namespace App\Domain\Payout;

use App\Contest;
use Stripe\BalanceTransaction;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Payout as StripePayout;

class PlatformPayout
{
    /**
     * Create the platform payout.
     *
     * @param Contest $contest The contest used to transfer funds from.
     * @throws ApiErrorException If there is a Stripe API error.
     */
    public function create(Contest $contest)
    {
        $payoutAmount = $this->calculatePayoutAmount($contest);

        $this->createContestPayout($contest, $payoutAmount);
    }

    /**
     * Calculate the payout amount.
     *
     * Subtract any occurred Stripe fees from the payout to keep our balance intact.
     *
     * @param Contest $contest The contest to fetch the amount and fees for.
     * @return int The calculated amount that will be available for payout.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function calculatePayoutAmount(Contest $contest)
    {
        $transaction = $this->retrieveTransaction($contest);

        return $contest->payment->fee - $transaction->fee;
    }

    /**
     * Retrieve the Stripe balance transaction.
     *
     * @param Contest $contest The contest to fetch the transaction id for.
     * @return BalanceTransaction A Stripe BalanceTransaction containing info about Stripe fees.
     * @throws ApiErrorException Thrown if the balance could not be retrieved.
     */
    private function retrieveTransaction(Contest $contest)
    {
        $paymentIntent = $this->retrievePaymentIntent($contest);

        $transaction = $paymentIntent->charges->data[0]->balance_transaction;

        return BalanceTransaction::retrieve($transaction);
    }

    /**
     * Retrieve the Stripe payment intent.
     *
     * @param Contest $contest The contest to retrieve the original payment intent(charge) for.
     * @return PaymentIntent The payment intent with all payment metadata like occurred transactional charges.
     * @throws ApiErrorException Thrown if the payment intent could not be retrieved.
     */
    private function retrievePaymentIntent(Contest $contest)
    {
        return PaymentIntent::retrieve($contest->payment->payment_id);
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
