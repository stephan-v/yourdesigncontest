<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
