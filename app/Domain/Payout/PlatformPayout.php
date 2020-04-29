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
        $this->createContestPayout($contest, $this->calculatePayoutAmount($contest));
    }

    /**
     * Calculate the payout amount.
     *
     * @param Contest $contest The contest to fetch the amount and fees for.
     * @return int The calculated amount that will be available for payout.
     * @throws ApiErrorException Thrown if the payment or balance could not be retrieved.
     */
    private function calculatePayoutAmount(Contest $contest)
    {
        $transaction = $this->retrieveTransaction($contest);

        // Subtract any occurred Stripe fees from the available payout amount to keep our balance intact.
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
        $paymentIntent = PaymentIntent::retrieve($contest->payment->payment_id);

        $charge = $paymentIntent->charges->data[0];

        return BalanceTransaction::retrieve($charge->balance_transaction);
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
