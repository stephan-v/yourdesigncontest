<?php

namespace App\Domain\Payment;

use App\Domain\Response\TransferResponse;
use App\User;
use Stripe\Exception\ApiErrorException;
use Stripe\Transfer;

class StripePaymentGateway implements PaymentGateway
{
    /**
     * @inheritDoc
     * @throws ApiErrorException Thrown if the transfer could not be completed.
     */
    public function transfer(User $user, int $amount, string $currency): TransferResponse
    {
        $transfer = Transfer::create([
            'amount' => $amount,
            'currency' => $currency,
            'destination' => $user->stripe_connect_id,
        ]);

        return new TransferResponse(
            $transfer->amount,
            $transfer->currency,
            $transfer->destination,
            $transfer->id
        );
    }
}
