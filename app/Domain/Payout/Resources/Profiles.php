<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

class Profiles extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'profiles';

    /**
     * Get all profiles.
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
