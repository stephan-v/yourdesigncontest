<?php

namespace App\Domain\Payout;

use App\Domain\Payout\Resources\AccountRequirements;
use App\Domain\Payout\Resources\Accounts;
use App\Domain\Payout\Resources\Profiles;
use App\Domain\Payout\Resources\Quotes;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

class TransferWise extends AbstractClient
{
    /**
     * Returns a new profiles client.
     *
     * @return Profiles
     */
    public function profiles()
    {
        return new Profiles(
            $this->clone('profiles')
        );
    }

    /**
     * Returns new account client.
     *
     * @return mixed
     */
    public function accounts()
    {
        return new Accounts(
            $this->clone('accounts')
        );
    }

    /**
     * Returns a new quotes client.
     *
     * @return Quotes
     */
    public function quotes()
    {
        return new Quotes(
            $this->clone('quotes')
        );
    }

    /**
     * Returns a new quotes client.
     *
     * @return AccountRequirements
     */
    public function accountRequirements()
    {
        return new AccountRequirements(
            $this->clone('account-requirements')
        );
    }

    /**
     * Clone the immutable Guzzle client and append the base uri with a resource parameter.
     *
     * @param string $resource The restful resource to target.
     * @return Client A new Guzzle client specific to the given resource.
     */
    private function clone(string $resource)
    {
        $config = $this->client->getConfig();

        $uri = (string) $config['base_uri'] . $resource;

        // Update the base uri.
        $config['base_uri'] = new Uri($uri);

        return new Client($config);
    }
}
