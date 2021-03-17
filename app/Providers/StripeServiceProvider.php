<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        Stripe::setApiVersion('2020-08-27');
    }
}
