<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DatabaseNotification::create([
            'id' => 'c595348a-c28b-4771-95cc-88e8c71bcfd0',
            'type' => Comment::class,
            'notifiable_type' => User::class,
            'notifiable_id' => 1,
            'data' => [
                'avatar' => 'http://yourdesigncontest.test/avatars/user.svg',
                'message' => '<b>Prof. Elfrieda Larkin MD<\b> commented on your submission.',
                'route' => 'http:\/\/yourdesigncontest.test/contests/1',
            ],
        ]);
    }
}
