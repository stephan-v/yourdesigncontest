<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

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
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function get(): array
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }
}
