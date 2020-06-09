<?php

namespace App\Observers;

use App\Events\PayoutStatusUpdated;
use App\Payout;

class PayoutObserver
{
    /**
     * Handle the payout "updated" event.
     *
     * @param Payout $payout The payout that has been updated.
     */
    public function updated(Payout $payout)
    {
        event(new PayoutStatusUpdated($payout));
    }
}
