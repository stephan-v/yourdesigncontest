<?php

namespace App\Presenters;

use App\Contest;
use Carbon\CarbonInterface;
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
        return $this->payment()->exists();
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
     * @return string The human readable expiration date.
     * @throws Exception Thrown if a Carbon exception is thrown.
     */
    public function getEndsInAttribute()
    {
        return $this->expires_at->isFuture()
            ? $this->expires_at->diffForHumans(['syntax' => CarbonInterface::DIFF_ABSOLUTE])
            : 'finished';
    }

    /**
     * Get the contest's finished state.
     *
     * @return boolean Whether the contest is finished or not.
     * @throws Exception Emits Exception in case of an error.
     */
    public function getFinishedAttribute()
    {
        return $this->expires_at->isPast() || $this->winner;
    }

    /**
     * Get the contest's active state.
     *
     * @return boolean Whether the contest is active or not.
     */
    public function getActiveAttribute()
    {
        return !$this->finished && !$this->winner;
    }

    /**
     * Get the winning submission of the contest.
     */
    public function getWinnerAttribute()
    {
        return $this->submissions()->has('winner')->first();
    }

    /**
     * Get the contestants of the contest.
     */
    public function getContestantsAttribute()
    {
        return $this->submissions->pluck('user')->unique();
    }
}
