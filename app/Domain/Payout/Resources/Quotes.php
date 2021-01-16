<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

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
     * @param int $amount The amount to get a quote for.
     * @param string $source The source currency.
     * @param string $target The target currency.
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function create(int $amount, string $source, string $target): array
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => config('services.transferwise.profile'),
                'source' => $source,
                'target' => $target,
                'rateType' => 'FIXED',
                'targetAmount' => $amount,
                'type' => 'BALANCE_PAYOUT',
            ]
        ]);

        return $this->json($response);
    }
}
