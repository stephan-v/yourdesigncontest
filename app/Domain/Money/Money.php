<?php

namespace App\Domain\Money;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as MoneyPHP;
use NumberFormatter;

class Money
{
    private $money;

    public function __construct(int $amount)
    {
        $this->money = new MoneyPHP($amount, resolve(Currency::class));
    }

    /**
     * Returns a new money formatter.
     *
     * @param string $locale The locale which specifies how to format an amount.
     * @return IntlMoneyFormatter A money formatter instance.
     */
    public function formatter(string $locale = 'en_US'): IntlMoneyFormatter
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter;
    }

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
     * Proxy all method calls that are not found directly to the money object.
     *
     * @param string $method The method name which is being called.
     * @param mixed $parameters The parameters provided to the method.
     * @return mixed The return value of the method.
     */
    public function __call($method, $parameters)
    {
        $this->money->{$method}(...$parameters);

        return $this;
    }
}
