<?php

namespace App\Domain\Money;

use Money\Currency;
use Money\Money as MoneyPHP;

class Money
{
    use Formatter;

    /**
     * The prepared money object.
     *
     * @var MoneyPHP
     */
    private $money;

    /**
     * Initialize a new money instance.
     *
     * @param int $amount The raw amount in cents.
     */
    public function __construct(int $amount)
    {
        $this->money = new MoneyPHP($amount, resolve(Currency::class));
    }

    /**
     * Returns the value represented by this object.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->money->getAmount();
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
        $this->money = $this->money->{$method}(...$parameters);

        return $this;
    }
}
