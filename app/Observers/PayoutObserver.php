<?php

namespace App\Observers;

use App\Events\PayoutStatusUpdated;
use App\Exceptions\DuplicatePayoutException;
use App\Models\Payout;

class PayoutObserver
{
    /**
     * Handle the payout "creating" event.
     *
     * @param Payout $payout The payout that is being created.
     * @throws DuplicatePayoutException Thrown if there is a duplicate payout.
     */
    public function creating(Payout $payout)
    {
        if ($payout->contest->payout) {
            Throw new DuplicatePayoutException('Payout already exists for this contest.');
        }
    }

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
