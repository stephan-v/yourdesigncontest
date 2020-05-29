<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class Quotes extends AbstractClient
{
    /**
     * Create a quote.
     *
     * @return mixed
     */
    public function create()
    {
        $response = $this->client->post('quotes', [
            'json' => [
                'profile' => 20233,
                'source' => 'EUR',
                'target' => 'GBP',
                'rateType' => 'FIXED',
                'targetAmount' => 600,
                'type' => 'BALANCE_PAYOUT',
            ]
        ]);

        return $this->decode($response);
    }
}
