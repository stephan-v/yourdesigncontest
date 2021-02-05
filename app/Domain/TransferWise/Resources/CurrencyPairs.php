<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;

class CurrencyPairs extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v1/currency-pairs';

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
