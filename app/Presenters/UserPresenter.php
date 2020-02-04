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

    /**
     * Whether the user is Stripe connect verified or not.
     *
     * @return bool Whether the user has gone through the connect onboarding or not.
     */
    public function getIsNotVerifiedAttribute(): bool
    {
        return (bool) $this->stripe_connect_id;
    }
}
