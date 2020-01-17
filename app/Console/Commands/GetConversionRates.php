<?php

namespace App\Console\Commands;

use App\ExchangeRate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GetConversionRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conversions:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the conversion rates from fixer.io';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $response = $client->get($this->url());

        $content = json_decode($response->getBody(), true);

        // Only fetch the EUR/USD rate for now.
        $key = 'USD';

        ExchangeRate::create([
            'rate' => $content['rates'][$key],
            'from' => $content['base'],
            'to' => $key,
        ]);
    }

    /**
     * Build the full fixer.io URL.
     *
     * @returns string The full url to make conversion rate requests.
     */
    private function url(): string
    {
        $url = config('services.fixer.url');
        $key = config('services.fixer.key');

        return $url . Arr::query(['access_key' => $key]);
    }
}
