<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;

class Profiles extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v1/profiles';

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
