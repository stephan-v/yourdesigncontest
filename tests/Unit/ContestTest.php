<?php

namespace Tests\Unit;

use App\Contest;
use App\Submission;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ContestTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_get_contest_contestants()
    {
        // Arrange.
        $user = factory(User::class)->create();
        $contest = $user->contests()->save(factory(Contest::class)->make());

        // Act.
        $users = factory(User::class, 3)->create()->each(function(User $user)  use ($contest){
            $contest->submissions()->save(factory(Submission::class)->make(['user_id' => $user->id]));
        });

        // Assert.
        $this->assertEquals($users->pluck('id'), $contest->contestants->pluck('id'));
    }
}
