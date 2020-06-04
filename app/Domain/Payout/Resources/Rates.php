<?php

namespace App\Domain\Payout\Resources;

use App\Domain\Payout\AbstractClient;

class Rates extends AbstractClient
{
    /**
     * The targeted API resource.
     *
     * @var $resource
     */
    private $resource = 'rates';

    /**
     * Fetch latest exchange rates of all currencies.
     *
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get($this->resource);

        return $this->json($response);
    }
}
