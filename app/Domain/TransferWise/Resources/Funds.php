<?php

namespace App\Domain\TransferWise\Resources;

use App\Domain\TransferWise\AbstractClient;

class Funds extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var string $resource
     */
    private $resource = 'v3/profiles/{profileId}/transfers/{transferId}/payments';

    /**
     * Create a transfer fund.
     *
     * @param int $transferId The id of the transfer that we want to fund.
     * @return mixed
     */
    public function create(int $transferId)
    {
        $uri = strtr($this->resource, [
            '{profileId}' => $this->profileId,
            '{transferId}' => $transferId,
        ]);

        $response = $this->client->post($uri, [
            'json' => [
                'type' => 'BALANCE'
            ]
        ]);

        return $this->json($response);
    }
}
