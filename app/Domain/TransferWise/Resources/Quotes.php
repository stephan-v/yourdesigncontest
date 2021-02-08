<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

class Quotes extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var $resource
     */
    private $resource = 'v1/quotes';

    /**
     * Create a quote.
     *
     * @param int $amount The amount in cents to get a quote for.
     * @param string $source The source currency.
     * @param string $target The target currency.
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function create(int $amount, string $source, string $target): array
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => $this->profileId,
                'source' => $source,
                'target' => $target,
                'rateType' => 'FIXED',
                'targetAmount' => $amount / 100,
                'type' => 'BALANCE_PAYOUT',
            ]
        ]);

        return $this->json($response);
    }
}
