<?php

namespace App\Domain\Payout;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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

        return $this->response($response);
    }

    /**
     * Send an email for account creation.
     *
     * @return mixed
     */
    public function accounts()
    {
        $response = $this->client->post('accounts', [
            'json' => [
                'profile' => 20233,
                'accountHolderName' => 'Stephan de Vries',
                'currency' => 'EUR',
                'type' => 'email',
                'details' => [
                    'email' => 'stephan-v@hotmail.com',
                ]
            ]
        ]);

        return $this->response($response);
    }

    /**
     * Convert the response to a json decoded associative PHP array.
     *
     * @param ResponseInterface $response The server response.
     * @return mixed The JSON decoded response.
     */
    private function response(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }
}
