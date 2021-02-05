<?php

namespace App\Domain\Money;

use App\Domain\TransferWise\TransferWise;
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
        // @TODO move the caching to a job.
        $rates = Cache::remember('rates', 3600, function () {
            return collect($this->client->rates()->get());
        });

        // Map into the correct structure for the FixedExchange class.
        $rates = $rates->reduce(function($carry, $item) {
            $carry[$item['source']][$item['target']] = $item['rate'];

            return $carry;
        }, []);

        $exchange = new ReversedCurrenciesExchange(new FixedExchange($rates));

        $converter = new \Money\Converter(new ISOCurrencies(), $exchange);

        return $converter->convert($money, resolve(Currency::class));
    }
}
