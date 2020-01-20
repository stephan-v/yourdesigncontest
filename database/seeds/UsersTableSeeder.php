<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'TestAccount',
            'email' => 'test-account@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('test'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        factory(User::class, 5)->create();
    }
}
