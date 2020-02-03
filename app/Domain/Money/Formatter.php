<?php

namespace App\Domain\Money;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

trait Formatter
{
    /**
     * Format the given amount using the currency set on the user record.
     *
     * @return string A formatted amount.
     */
    public function format()
    {
        return $this->formatter()->format($this->money);
    }

    /**
     * Returns a new money formatter.
     *
     * @param string $locale The locale which specifies how to format an amount.
     * @return IntlMoneyFormatter A money formatter instance.
     */
    private function formatter(string $locale = 'en_US'): IntlMoneyFormatter
    {
        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $currencies = new ISOCurrencies();

        return new IntlMoneyFormatter($numberFormatter, $currencies);
    }
}
