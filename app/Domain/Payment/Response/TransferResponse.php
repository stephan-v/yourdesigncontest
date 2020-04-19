<?php

namespace App\Domain\Response;

class TransferResponse
{
    /**
     * The amount that was transferred.
     *
     * @var int $amount
     */
    public $amount;

    /**
     * The currency used for the transfer.
     *
     * @var string $currency
     */
    public $currency;

    /**
     * The stripe connect user that was the destination for the transfer.
     *
     * @var string $destination
     */
    public $destination;

    /**
     * The transfer id.
     *
     * @var string $id
     */
    public $id;

    /**
     * TransferResponse constructor.
     *
     * @param int $amount The amount that was transferred.
     * @param string $currency The currency used for the transfer.
     * @param string $destination The stripe connect user that was the destination for the transfer.
     * @param string $id The transfer id.
     */
    public function __construct(int $amount, string $currency, string $destination, string $id)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->destination = $destination;
        $this->id = $id;
    }
}
