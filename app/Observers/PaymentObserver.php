<?php

namespace App\Observers;

use App\Events\ContestPaid;
use App\Payment;

class PaymentObserver
{
    /**
     * Handle the payout "created" event.
     *
     * @param Payment $payment The payment that was created.
     */
    public function created(Payment $payment)
    {
        event(new ContestPaid($payment->user));
    }
}
