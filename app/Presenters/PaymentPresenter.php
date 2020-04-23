<?php

namespace App\Presenters;

use App\Domain\Money\Formatter;
use Money\Money;
use Money\Currency;

trait PaymentPresenter
{
    /**
     * The amount converted to a money object.
     *
     * @return Money The money object.
     */
    public function getMoneyAttribute()
    {
        return new Money($this->amount, resolve(Currency::class));
    }

    /**
     * The payout amount for winning designers.
     *
     * @return string The payout price in cents.
     */
    public function getWinningsAttribute()
    {
        $decimalPercentage = config('services.stripe.platform_fee') / 100;

        return $this->money->divide(1 + $decimalPercentage);
    }

    /**
     * Subtract the designers payout from the contest payment leaving us with our fee.
     *
     * The initial payment includes the designers payout and the platform fee.
     *
     * @return int The platform fee in the smallest denominator.
     */
    public function getFeeAttribute(): int
    {
        return $this->money->subtract($this->winnings)->getAmount();
    }

    /**
     * The formatted payout amount for designers.
     *
     * @return string The currency formatted payout price.
     */
    public function getFormattedPayoutAttribute()
    {
        return (new Formatter($this->money))->format();
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
