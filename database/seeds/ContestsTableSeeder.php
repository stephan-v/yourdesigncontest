<?php

use App\Contest;
use App\Payment;
use Illuminate\Database\Seeder;

class ContestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Contest::class, 5)->create()->each(function (Contest $contest) {
            $contest->payment()->save(factory(Payment::class)->make());
        });
    }
}
