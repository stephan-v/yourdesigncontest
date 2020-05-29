<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class Accounts extends AbstractClient
{
    public function get()
    {
        $response = $this->client->get('accounts');

        return $this->decode($response);
    }

    /**
     * Create an account.
     *
     * @return mixed
     */
    public function create()
    {
        $response = $this->client->post('accounts', [
            'json' => [
                'profile' => 20233,
                'accountHolderName' => 'Stephan de Vries',
                'currency' => 'EUR',
                'type' => 'email',
                'details' => [
                    'email' => 'stephandevrieschristiaan@gmail.com',
                ]
            ]
        ]);

        return $this->decode($response);
    }
}
