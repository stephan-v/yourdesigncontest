<?php

use App\Contest;
use App\User;
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
        $user = User::findOrFail(1);

        factory(Contest::class, 50)->create()->each(function (Contest $contest) use ($user) {
            $contest = $user->contests()->save(factory(Contest::class)->make());

            factory(Transaction::class, 1)->create([
                'contest_id' => $contest->id,
            ]);
        });
    }
}
