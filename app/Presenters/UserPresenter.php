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
}
