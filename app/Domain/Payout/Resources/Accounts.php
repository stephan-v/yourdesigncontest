<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use App\User;

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

        return $this->json($response);
    }

    /**
     * Create an account.
     *
     * @param User $user The user to create an account for.
     * @return mixed
     */
    public function create(User $user)
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => config('services.transferwise.profile'),
                'accountHolderName' => $user->name, // Recipient full name.
                'currency' => 'GBP',
                'type' => 'email',
                'details' => [
                    'email' => $user->email,
                ]
            ]
        ]);

        return $this->json($response);
    }
}
