<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;

class Accounts extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v1/accounts';

    /**
     * Get all accounts.
     *
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function get(): array
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }

    /**
     * Create a recipient account.
     *
     * @param User $user The user to create an account for.
     * @param string $currency The currency used to set up the account.
     * @return array The data.
     * @throws GuzzleException Thrown if the Guzzle request fails.
     */
    public function create(User $user, string $currency): array
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'profile' => $this->profileId,
                'accountHolderName' => $user->name, // Recipient full name.
                'currency' => $currency,
                'type' => 'email',
                'details' => [
                    'email' => $user->email,
                ],
            ]
        ]);

        return $this->json($response);
    }
}
