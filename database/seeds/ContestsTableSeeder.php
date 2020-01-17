<?php

use App\Contest;
use App\Transaction;
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
            $contest->transaction()->save(factory(Transaction::class)->make());
        });
    }
}
