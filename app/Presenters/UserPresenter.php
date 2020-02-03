<?php

namespace App\Presenters;

use Illuminate\Support\Str;

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
     * Generate the Stripe connect URI.
     *
     * @return string The generated URI.
     */
    public function getStripeConnectUriAttribute(): string
    {
        $params = http_build_query([
            'client_id' => config('services.stripe.connect.client_id'),
            'stripe_user[business_type]' => 'individual',
            'stripe_user[email]' => $this->email,
            'stripe_user[url]' => Str::replaceFirst('.test', '.com', route('users.show', ['user' => $this])),
            'suggested_capabilities[]' => 'transfers',
            'state' => 'test',
        ]);

        return config('services.stripe.connect.uri') . $params;
    }
}