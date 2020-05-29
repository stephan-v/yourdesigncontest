<?php

namespace App\Domain\Payout;

use App\Domain\Payout\Resources\AccountRequirements;
use App\Domain\Payout\Resources\Accounts;
use App\Domain\Payout\Resources\Profiles;
use App\Domain\Payout\Resources\Quotes;
use App\Domain\Payout\Resources\Transfers;

class TransferWise extends AbstractClient
{
    /**
     * Returns a new profiles client.
     *
     * @return Profiles
     */
    public function profiles()
    {
        return new Profiles($this->client);
    }

    /**
     * Returns new account client.
     *
     * @return Accounts
     */
    public function accounts()
    {
        return new Accounts($this->client);
    }

    /**
     * Returns a new quotes client.
     *
     * @return Quotes
     */
    public function quotes()
    {
        return new Quotes($this->client);
    }

    /**
     * Returns a new transfers client.
     *
     * @return Transfers
     */
    public function transfers()
    {
        return new Transfers($this->client);
    }

    /**
     * Returns a new quotes client.
     *
     * @return AccountRequirements
     */
    public function accountRequirements()
    {
        return new AccountRequirements($this->client);
    }
}
