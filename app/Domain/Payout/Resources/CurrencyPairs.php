<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class CurrencyPairs extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'currency-pairs';

    /**
     * Get the currency pairs that can be used to setup transfers.
     *
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }
}
