<?php

use App\Submission;
use Illuminate\Database\Seeder;

class SubmissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Submission::class, 15)->create();
    }
}
