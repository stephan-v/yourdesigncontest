<?php

namespace App\Presenters;

use App\Payout;
use Money\Currency;
use Money\Money;

trait PayoutPresenter
{
    /**
     * The amount converted to a money object.
     *
     * @return Money The money object.
     */
    public function getMoneyAttribute(): Money
    {
        return new Money($this->amount, resolve(Currency::class));
    }

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
