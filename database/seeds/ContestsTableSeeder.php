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
        // Default contests.
        factory(Contest::class, 20)->create()->each(function (Contest $contest) {
            $contest->payment()->save(factory(Payment::class)->make());
        });

        // Finished contest.
        factory(Contest::class, 1)->states('finished')->create()->each(function (Contest $contest) {
            $contest->payment()->save(factory(Payment::class)->make());
        });
    }
}
