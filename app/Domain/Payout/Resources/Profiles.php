<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use GuzzleHttp\Client;

class Profiles extends AbstractClient
{
    /**
     * The resource this client targets.
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
        $response = $this->client->get('profiles');

        return $this->decode($response);
    }
}
