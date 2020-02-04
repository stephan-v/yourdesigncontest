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
    public function getIsStripeVerifiedAttribute(): bool
    {
        return isset($this->stripe_connect_id);
    }

    /**
     * Whether the user is Stripe connect verified or not.
     *
     * @return bool Whether the user has gone through the connect onboarding or not.
     */
    public function getIsNotStripeVerifiedAttribute(): bool
    {
        return !$this->isStripeVerified;
    }
}
