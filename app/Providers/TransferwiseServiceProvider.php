<?php

namespace App\Providers;

use App\Domain\Payout\TransferWise;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TransferwiseServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TransferWise::class, function () {
            $client = new Client(
                [
                    'base_uri' => config('services.transferwise.uri'),
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('services.transferwise.key'),
                    ],
                ]
            );

            return new TransferWise($client);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TransferWise::class];
    }
}
