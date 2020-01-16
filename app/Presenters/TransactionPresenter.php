<?php

namespace App\Presenters;

use App\Domain\Money\Money;

trait TransactionPresenter
{
    /**
     * The amount represented as a money object.
     *
     * @param int $value The raw amount of the transaction.
     * @return Money The money object for a given amount.
     */
    public function getAmountAttribute(int $value)
    {
        return new Money($value);
    }

    /**
     * The payout amount for designers.
     *
     * @return string The payout price in cents.
     */
    public function getPayoutAttribute()
    {
        return $this->amount->multiply(0.9)->format();
    }
}
