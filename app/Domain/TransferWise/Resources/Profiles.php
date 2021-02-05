<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;

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
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }
}
