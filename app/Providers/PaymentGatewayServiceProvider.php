<?php

namespace App\Providers;

use App\Domain\Payment\PaymentGateway;
use App\Domain\Payment\StripePaymentGateway;
use Illuminate\Support\ServiceProvider;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGateway::class, function () {
            return new StripePaymentGateway();
        });
    }
}
