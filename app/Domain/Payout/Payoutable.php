<?php

namespace App\Domain\Payout;

use App\Exceptions\PayoutException;
use App\Jobs\TransferFunds;
use App\Payout;

trait Payoutable
{
    /**
     * Creat a user payout.
     *
     * @throws PayoutException Thrown if there are no pending payouts.
     */
    public function createPayout()
    {
        $payouts = $this->payouts()->pending()->get();

        if (!$this->isStripeVerified) {
            throw PayoutException::missingConnectAccount();
        }

        if (!count($payouts)) {
            throw PayoutException::noPendingPayouts();
        }

        /** @var Payout $payout */
        foreach ($payouts as $payout) {
            TransferFunds::dispatch($payout);
        }
    }
}
