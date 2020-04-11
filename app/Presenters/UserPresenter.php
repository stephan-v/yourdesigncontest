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

    /**
     * Get the users's full avatar path.
     *
     * @param null|string $value The filename of the image.
     * @return null|string The image path of the avatar.
     */
    public function getAvatarAttribute(?string $value): ?string
    {
        return $value ? asset("avatars/{$value}") : asset('/avatars/user.svg');
    }

    /**
     * Generate a Stripe connect onboarding url with pre-filled data.
     *
     * @return string The Stripe connect onboarding url.
     */
    public function getOnboardingUrlAttribute(): string
    {
        $params = http_build_query([
            'client_id' => config('services.stripe.connect.client_id'),
            'stripe_user[business_type]' => 'individual',
            'stripe_user[email]' => $this->email,
            'stripe_user[url]' => route('users.show', $this),
            'suggested_capabilities[]' => 'transfers',
            'state' => 'test',
        ]);

        return config('services.stripe.connect.uri') . $params;
    }
}
