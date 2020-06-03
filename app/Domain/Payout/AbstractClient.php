<?php

namespace App\Domain\Payout;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient
{
    /**
     * The pre-configured Guzzle client which has the base uri and auth token.
     *
     * @var Client
     */
    protected $client;

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
     * Convert the response to a json decoded associative PHP array.
     *
     * @param ResponseInterface $response The server response.
     * @return mixed The JSON decoded response.
     */
    protected function json(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }
}
