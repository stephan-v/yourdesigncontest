<?php

namespace App\Providers;

use App\Domain\Payout\TransferWise;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class TransferwiseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (is_null(config('services.transferwise.profile'))) {
            throw new RuntimeException('Environment variable failed assertion: TRANSFERWISE_PROFILE_ID is missing');
        }

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
}
