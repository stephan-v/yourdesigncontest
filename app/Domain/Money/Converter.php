<?php

namespace App\Domain\Money;

use App\Domain\Payout\TransferWise;
use Illuminate\Support\Facades\Cache;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exchange\FixedExchange;
use Money\Exchange\ReversedCurrenciesExchange;
use Money\Money;

class Converter
{
    /**
     * The TransferWise client used to fetch exchange rates.
     *
     * @var TransferWise $client
     */
    private $client;

    /**
     * Initialize a new currency converter.
     */
    public function __construct()
    {
        $this->client = resolve(TransferWise::class);
    }

    /**
     * Convert a given money amount using exchange rates.
     *
     * @param Money $money The amount to convert.
     * @return Money The converted money object.
     */
    public function convert(Money $money): Money
    {
        // @TODO possibly move the caching to a job.
        $rate = Cache::remember('EUR/USD', 3600, function () {
            return $this->client->rates()->get('EUR', 'USD')[0]['rate'];
        });

        $exchange = new ReversedCurrenciesExchange(new FixedExchange([
            'EUR' => [
                'USD' => $rate,
            ]
        ]));

        $converter = new \Money\Converter(new ISOCurrencies(), $exchange);

        return $converter->convert($money, resolve(Currency::class));
    }
}
