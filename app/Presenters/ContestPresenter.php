<?php

namespace App\Presenters;

use App\Domain\Money\Money;
use Carbon\Carbon;
use Exception;

trait ContestPresenter
{
    /**
     * Determines if the contest has been paid for.
     *
     * @return bool Whether the contest has been paid for or not.
     */
    public function isPaidFor()
    {
        return $this->transaction()->exists();
    }

    /**
     * Determines if the contest has not been paid for.
     *
     * @return bool Whether the contest has been paid for or not.
     */
    public function isNotPaidFor() {
        return !$this->isPaidFor();
    }

    /**
     * Get the contests's expiration date.
     *
     * @param string $value The expiration timestamp.
     * @return string The human readable expiration date.
     * @throws Exception Thrown if a Carbon exception is thrown.
     */
    public function getExpiresAtAttribute($value)
    {
        $dateTime = new Carbon($value);

        return $dateTime->isFuture() ? $dateTime->diffForHumans() : 'finished';
    }

    /**
     * Get the contest's finished state.
     *
     * @return boolean Whether the contest is finished or not.
     */
    public function getFinishedAttribute()
    {
        return $this->winner()->exists();
    }

    /**
     * Get the contest's active state.
     *
     * @return boolean Whether the contest is active or not.
     */
    public function getActiveAttribute()
    {
        return !$this->finished;
    }
}
