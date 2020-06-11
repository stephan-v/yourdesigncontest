<?php

namespace App\Domain\Payout;

use App\Domain\Payout\Resources\AccountRequirements;
use App\Domain\Payout\Resources\Accounts;
use App\Domain\Payout\Resources\CurrencyPairs;
use App\Domain\Payout\Resources\Profiles;
use App\Domain\Payout\Resources\Quotes;
use App\Domain\Payout\Resources\Rates;
use App\Domain\Payout\Resources\Transfers;

class TransferWise extends AbstractClient
{
    /**
     * Returns new account client.
     *
     * @return Accounts
     */
    public function accounts(): Accounts
    {
        return new Accounts($this->client);
    }

    /**
     * Returns a new quotes client.
     *
     * @return AccountRequirements
     */
    public function accountRequirements(): AccountRequirements
    {
        return new AccountRequirements($this->client);
    }

    /**
     * Returns a new currency pairs client.
     *
     * @return CurrencyPairs
     */
    public function currencyPairs(): CurrencyPairs
    {
        return new CurrencyPairs($this->client);
    }

    /**
     * Returns a new profiles client.
     *
     * @return Profiles
     */
    public function profiles(): Profiles
    {
        return new Profiles($this->client);
    }

    /**
     * Returns a new quotes client.
     *
     * @return Quotes
     */
    public function quotes(): Quotes
    {
        return new Quotes($this->client);
    }

    /**
     * Returns a new rates client.
     *
     * @return Rates
     */
    public function rates(): Rates
    {
        return new Rates($this->client);
    }

    /**
     * Returns a new transfers client.
     *
     * @return Transfers
     */
    public function transfers(): Transfers
    {
        return new Transfers($this->client);
    }
}
