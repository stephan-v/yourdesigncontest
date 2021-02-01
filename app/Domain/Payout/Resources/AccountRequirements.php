<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

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
     * @return mixed
     */
    public function get()
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
