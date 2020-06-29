<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            'EUR',
            'GBP',
            'INR',
            'USD',
            'AED',
            'ARS',
            'AUD',
            'BDT',
            'BGN',
            'BRL',
            'BWP',
            'CAD',
            'CHF',
            'CLP',
            'CNY',
            'COP',
            'CRC',
            'CZK',
            'DKK',
            'EGP',
            'GEL',
            'GHS',
            'HKD',
            'HRK',
            'HUF',
            'IDR',
            'ILS',
            'JPY',
            'KES',
            'KRW',
            'LKR',
            'MAD',
            'MXN',
            'MYR',
            'NGN',
            'NOK',
            'NPR',
            'NZD',
            'PEN',
            'PHP',
            'PKR',
            'PLN',
            'RON',
            'RUB',
            'SEK',
            'SGD',
            'THB',
            'TRY',
            'TZS',
            'UAH',
            'UGX',
            'UYU',
            'VND',
            'XOF',
            'ZAR',
            'ZMW',
        ];

        // Transform currency codes to long names.
        $iso4217 = new Alcohol\ISO4217();

        foreach ($currencies as $currency) {
            Currency::create([
                'code' => $currency,
                'name' => $iso4217->getByCode($currency)['name'],
            ]);
        }
    }
}
