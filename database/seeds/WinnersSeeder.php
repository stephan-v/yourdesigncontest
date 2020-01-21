<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WinnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('winners')->insert([
            'submission_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
