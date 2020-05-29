<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class Accounts extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'accounts';

    /**
     * Get all accounts.
     *
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->decode($response);
    }

    /**
     * Create an account.
     *
     * @return mixed
     */
    public function create()
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => config('services.transferwise.profile'),
                'accountHolderName' => 'Testing',
                'currency' => 'GBP',
                'type' => 'email',
                'details' => [
                    'email' => 'testmaster@hotmail.com',
                ]
            ]
        ]);

        return $this->decode($response);
    }
}
