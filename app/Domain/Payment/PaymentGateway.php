<?php

namespace App\Domain\Payment;

use App\User;

interface PaymentGateway
{
    /**
     * Transfer a given amount from the platform to a connect user.
     *
     * @param User $user The user to transfer the given amount to.
     * @param int $amount The amount to transfer.
     * @param string $currency The currency used to transfer.
     * @return mixed
     */
    public function transfer(User $user, int $amount, string $currency);
}
