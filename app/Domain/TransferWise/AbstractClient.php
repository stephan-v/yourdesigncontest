<?php

namespace App\Domain\TransferWise;

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
     * The TransferWise profile id.
     *
     * @var string $profileId
     */
    protected $profileId;

    /**
     * TransferWise constructor.
     *
     * @param Client $client The pre-configured Guzzle client.
     * @param int $profileId The TransferWise profile id.
     */
    public function __construct(Client $client, int $profileId)
    {
        $this->client = $client;
        $this->profileId = $profileId;
    }

    /**
     * Convert the response to a json decoded associative PHP array.
     *
     * @param ResponseInterface $response The server response.
     * @return array The JSON decoded response.
     */
    protected function json(ResponseInterface $response): array
    {
        return json_decode($response->getBody(), true);
    }
}
