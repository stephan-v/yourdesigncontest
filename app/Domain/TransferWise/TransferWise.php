<?php

namespace App\Domain\TransferWise;

use App\Domain\TransferWise\Resources\AccountRequirements;
use App\Domain\TransferWise\Resources\Accounts;
use App\Domain\TransferWise\Resources\CurrencyPairs;
use App\Domain\TransferWise\Resources\Profiles;
use App\Domain\TransferWise\Resources\Quotes;
use App\Domain\TransferWise\Resources\Rates;
use App\Domain\TransferWise\Resources\Transfers;

class TransferWise extends AbstractClient
{
    /**
     * Returns new account client.
     *
     * @return Accounts
     */
    public function accounts(): Accounts
    {
        return new Accounts($this->client, $this->profileId);
    }

    /**
     * Returns a new quotes client.
     *
     * @return AccountRequirements
     */
    public function accountRequirements(): AccountRequirements
    {
        return new AccountRequirements($this->client, $this->profileId);
    }

    /**
     * Returns a new currency pairs client.
     *
     * @return CurrencyPairs
     */
    public function currencyPairs(): CurrencyPairs
    {
        return new CurrencyPairs($this->client, $this->profileId);
    }

    /**
     * Returns a new profiles client.
     *
     * @return Profiles
     */
    public function profiles(): Profiles
    {
        return new Profiles($this->client, $this->profileId);
    }

    /**
     * Returns a new quotes client.
     *
     * @return Quotes
     */
    public function quotes(): Quotes
    {
        return new Quotes($this->client, $this->profileId);
    }

    /**
     * Returns a new rates client.
     *
     * @return Rates
     */
    public function rates(): Rates
    {
        return new Rates($this->client, $this->profileId);
    }

    /**
     * Returns a new transfers client.
     *
     * @return Transfers
     */
    public function transfers(): Transfers
    {
        return new Transfers($this->client, $this->profileId);
    }
}
