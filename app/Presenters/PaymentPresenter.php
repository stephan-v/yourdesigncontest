<?php

namespace App\Presenters;

use App\Domain\Money\Converter;
use App\Domain\Money\Formatter;
use Illuminate\Support\Str;
use Money\Currency;
use Money\Money as MoneyPHP;

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
        // @TODO Remove the Stripe key because this is not related to Stripe.
        $decimalPercentage = config('services.stripe.platform_fee') / 100;

        return $this->money->divide(1 + $decimalPercentage);
    }

    /**
     * The money converted amount.
     *
     * @return MoneyPHP The MoneyPHP object.
     */
    public function getMoneyAttribute(): MoneyPHP
    {
        $currency = new Currency($this->currency);
        $money = new MoneyPHP($this->amount, $currency);

        if ($currency->equals(resolve(Currency::class))) {
            return $money;
        }

        return (new Converter())->convert($money);
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
