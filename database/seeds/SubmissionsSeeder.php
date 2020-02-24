<?php

use App\Submission;
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
            'title' => 'Amazing submission',
            'description' => 'You should pick this as a winner',
            'filename' => 'a6G50uLhxZbfadWjiBQZimG2evHtuF3esG40QuAY.png',
            'order' => 1,
            'contest_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        factory(Submission::class, 25)->create();
    }
}
