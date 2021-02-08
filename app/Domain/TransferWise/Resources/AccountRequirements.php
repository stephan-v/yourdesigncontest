<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

class AccountRequirements extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v1/account-requirements';

    /**
     * Get the account requirements.
     *
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function get(): array
    {
        $response = $this->client->get($this->resource, [
            'query' => [
                'source' => 'EUR',
                'target' => 'USD',
                'sourceAmount' => 1000,
            ]
        ]);

        return $this->json($response);
    }
}
