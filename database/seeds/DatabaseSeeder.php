<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ContestsTableSeeder::class);
        $this->call(SubmissionsSeeder::class);
        $this->call(StripeTestableSeeder::class);
        $this->call(CurrencySeeder::class);
    }
}
