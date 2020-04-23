<?php

namespace App\Presenters;

use App\Domain\Money\Formatter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Money\Currency;
use Money\Money;

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
     * Get the total amount available for payout.
     *
     * @return Money The money object containing the available total for payout.
     */
    public function getTotalPayoutAmountAttribute(): Money
    {
        $payouts = $this->payouts()->pending()->get();

        if (count($payouts)) {
            return $payouts->shift()->money->add(...$payouts->map->money);
        }

        return new Money(0, resolve(Currency::class));
    }

    /**
     * Get the total formatted amount available for payout in the user's preferred currency.
     *
     * @return string The formatted amount available for payout.
     */
    public function getFormattedTotalPayoutAmountAttribute(): string
    {
        return (new Formatter($this->totalPayoutAmount))->format();
    }

    /**
     * Generate a Stripe connect onboarding url with pre-filled data.
     *
     * @return string The Stripe connect onboarding url.
     */
    public function getOnboardingUrlAttribute(): string
    {
        $parameters = [
            'client_id' => config('services.stripe.connect.client_id'),
            'stripe_user[business_type]' => 'individual',
            'stripe_user[email]' => $this->email,
            'stripe_user[url]' => Str::replaceFirst('.test', '.com', route('users.show', $this)),
            'suggested_capabilities[]' => 'transfers',
        ];

        // Pre-fill data for easier local testing.
        if (App::environment('local')) {
            $parameters = array_merge($parameters, [
                'stripe_user[phone_number]' => '0000000000',
                'stripe_user[first_name]' => 'John',
                'stripe_user[last_name]' => 'Doe',
                'stripe_user[dob_day]' => 1,
                'stripe_user[dob_month]' => 1,
                'stripe_user[dob_year]' => 1980,
                'stripe_user[street_address]' => 'John Doe Lane',
                'stripe_user[zip]' => '1020JD',
                'stripe_user[city]' => 'John Doe City',
            ]);
        }

        $parameters = http_build_query($parameters);

        return config('services.stripe.connect.uri') . $parameters;
    }
}
