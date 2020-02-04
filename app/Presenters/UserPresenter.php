<?php

namespace App\Presenters;

trait UserPresenter
{
    /**
     * Set the user's currency.
     *
     * @param string $value The default currency used by the user.
     */
    public function setCurrencyAttribute(string $value)
    {
        $this->attributes['currency'] = strtoupper($value);
    }
}
