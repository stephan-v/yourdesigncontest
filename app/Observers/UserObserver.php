<?php

namespace App\Observers;

use App\User;
use Stripe\Account;
use Stripe\Exception\ApiErrorException;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param User $user The user which is being created.
     * @throws ApiErrorException If the request fails.
     */
    public function creating(User $user)
    {
        $account = Account::create([
            'business_type' => 'individual',
            'country' => 'NL',
            'type' => 'custom',
            'requested_capabilities' => [
                'card_payments',
                'transfers'
            ],
        ]);

        $user->stripe_id = $account['id'];
    }
}
