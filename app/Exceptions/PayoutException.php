<?php

namespace App\Exceptions;

use Exception;

class PayoutException extends Exception
{
    /**
     * Thrown if a user does not have any pending payouts available.
     *
     * @return static
     */
    public static function noPendingPayouts()
    {
        return new static('User does not have any pending payouts.');
    }

    /**
     * Thrown if a payout has already been made.
     *
     * @return static
     */
    public static function duplicatePayout()
    {
        return new static('A payout has already been made for this resource.');
    }

    /**
     * Thrown if a connect account could not be retrieve or user does not have a connect id.
     *
     * @return static
     */
    public static function missingConnectAccount()
    {
        return new static('Could not find a corresponding connect account.');
    }
}
