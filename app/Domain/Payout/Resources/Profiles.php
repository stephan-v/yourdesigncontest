<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

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
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->decode($response);
    }
}
