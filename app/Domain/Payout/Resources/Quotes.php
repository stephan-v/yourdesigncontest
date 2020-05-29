<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class Quotes extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var $resource
     */
    private $resource = 'quotes';

    /**
     * Create a quote.
     *
     * @return mixed
     */
    public function create()
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => config('services.transferwise.profile'),
                'source' => 'EUR',
                'target' => 'GBP',
                'rateType' => 'FIXED',
                'targetAmount' => 1337,
                'type' => 'BALANCE_PAYOUT',
            ]
        ]);

        return $this->decode($response);
    }
}
