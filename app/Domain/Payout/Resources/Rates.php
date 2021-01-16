<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

class Rates extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var $resource
     */
    private $resource = 'rates';

    /**
     * Fetch latest exchange rates of all currencies.
     *
     * @param string|null $source The source to convert from.
     * @param string|null $target The target to convert to.
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function get(string $source = null, string $target = null): array
    {
        $response = $this->client->get($this->resource, [
            'query' => [
                'source' => $source,
                'target' => $target,
            ]
        ]);

        return $this->json($response);
    }
}
