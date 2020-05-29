<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class AccountRequirements extends AbstractClient
{
    /**
     * Get the account requirements.
     *
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get('account-requirements', [
            'query' => [
                'source' => 'EUR',
                'target' => 'USD',
                'sourceAmount' => 1000,
            ]
        ]);

        return $this->decode($response);
    }
}
