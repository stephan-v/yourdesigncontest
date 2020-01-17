<?php

use Illuminate\Database\Seeder;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exchange_rates')->insert([
            'rate' => 1.11,
            'from' => 'EUR',
            'to' => 'USD',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
