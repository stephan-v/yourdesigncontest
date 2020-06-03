<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;
use Illuminate\Support\Str;

class Transfers extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'transfers';

    /**
     * Create a transfer.
     *
     * @param int $accountId The target account id.
     * @param int $quoteId The quote id.
     * @return mixed
     */
    public function create(int $accountId, int $quoteId)
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'targetAccount' => $accountId,
                'quote' => $quoteId,
                'customerTransactionId' => Str::uuid(),
                'details' => [
                    'reference' => 'YourDesignContest',
                    'transferPurpose' => 'Payment',
                    'sourceOfFunds' =>  'YourDesignContest',
                ],
            ]
        ]);

        return $this->json($response);
    }

    /**
     * Get all transfers.
     *
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }

    /**
     * Fund a transfer.
     *
     * @param int $transferId The id of the transfer that we want to fund.
     * @return mixed
     */
    public function fund(int $transferId)
    {
        $profileId = config('services.transferwise.profile');

        // Since TransferWise have mixed API versioning for some reason we include the URI here.
        $response = $this->client->post("https://api.sandbox.transferwise.tech/v3/profiles/{$profileId}/transfers/{$transferId}/payments", [
            'json' => [
                'type' => 'BALANCE'
            ]
        ]);

        return $this->json($response);
    }
}
