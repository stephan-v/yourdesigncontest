<?php

namespace App\Presenters;

use App\Models\Payout;

trait PayoutPresenter
{
    /**
     * Whether the payout has succeeded and it finished or not.
     *
     * @return bool True if the payout has been completed, otherwise false.
     */
    public function getSucceededAttribute(): bool
    {
        return $this->status === Payout::SUCCEEDED;
    }
}
