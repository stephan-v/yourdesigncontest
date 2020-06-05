<?php

namespace App\Casts;

use App\Domain\Money\Converter;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Money\Currency;
use Money\Money as MoneyPHP;

class Money implements CastsAttributes
{
    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $currency = new Currency($model->currency);
        $money = new MoneyPHP($value, $currency);

        if ($currency->equals(resolve(Currency::class))) {
            return $money;
        }

        return (new Converter())->convert($money);
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
