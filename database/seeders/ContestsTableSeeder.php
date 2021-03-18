<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Payment;
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
        Contest::factory()->count(5)->create()->each(function (Contest $contest) {
            $contest->payment()->save(Payment::factory()->make());
        });

        // Finished contest.
        Contest::factory()->finished()->create()->each(function (Contest $contest) {
            $contest->payment()->save(Payment::factory()->make());
        });
    }
}
