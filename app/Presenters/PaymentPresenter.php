<?php

namespace App\Presenters;

use App\Domain\Money\Money;

trait PaymentPresenter
{
    /**
     * The amount converted to a money object.
     *
     * @return Money A money object.
     */
    public function getMoneyAttribute()
    {
        return new Money($this->amount);
    }

    /**
     * The payout amount for designers.
     *
     * @return string The payout price in cents.
     */
    public function getPayoutAttribute()
    {
        return $this->money->multiply(0.9);
    }

    /**
     * The formatted payout amount for designers.
     *
     * @return string The currency formatted payout price.
     */
    public function getFormattedPayoutAttribute()
    {
        return $this->payout->format();
    }

    /**
     * Set the payment's currency.
     *
     * @param string $value The currency which was used for the payment.
     */
    public function setCurrencyAttribute(string $value)
    {
        $this->attributes['currency'] = strtoupper($value);
    }
}
