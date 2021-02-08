<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;
use GuzzleHttp\Exception\ClientException;

class Transfers extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v1/transfers';

    /**
     * Create a transfer.
     *
     * @param int $accountId The target account id.
     * @param int $quoteId The quote id.
     * @param string $transactionId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $accountId, int $quoteId, string $transactionId)
    {
        $response = $this->client->post($this->resource, [
            'json' => [
                'targetAccount' => $accountId,
                'quote' => $quoteId,
                'customerTransactionId' => $transactionId,
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
}
