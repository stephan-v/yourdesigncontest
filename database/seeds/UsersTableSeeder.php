<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the main test user and log in with that user.
        Auth::login(factory(User::class)->states('test')->create());

        factory(User::class, 5)->create();
    }
}
