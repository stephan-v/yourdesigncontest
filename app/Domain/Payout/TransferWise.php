<?php

namespace App\Domain\Payout;

use GuzzleHttp\Client;

class TransferWise
{
    /**
     * The pre-configured Guzzle client which has the base uri and auth token.
     *
     * @var Client
     */
    private $client;

    /**
     * TransferWise constructor.
     *
     * @param Client $client The pre-configured Guzzle client.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the TransferWise profile id.
     *
     * @return mixed
     */
    public function profiles()
    {
        $response = $this->client->get('profiles');

        return json_decode($response->getBody(), true);
    }
}
