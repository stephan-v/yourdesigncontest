<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submissions')->insert([
            'file' => 'submissions/1/a6G50uLhxZbfadWjiBQZimG2evHtuF3esG40QuAY.png',
            'contest_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
