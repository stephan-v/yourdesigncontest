<?php

namespace App\Presenters;

use App\Domain\Money\Formatter;

trait PaymentPresenter
{
    /**
     * The payout amount for winning designers.
     *
     * The calculation for this is the paid contest amount minus the percentage platform fee.
     *
     * @return string The payout price in cents.
     */
    public function getWinningsAttribute()
    {
        $decimalPercentage = config('services.stripe.platform_fee') / 100;

        return $this->amount->divide(1 + $decimalPercentage);
    }

    /**
     * The formatted payout amount for designers.
     *
     * @return string The currency formatted payout price.
     */
    public function getFormatAttribute()
    {
        return (new Formatter($this->winnings))->format();
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
