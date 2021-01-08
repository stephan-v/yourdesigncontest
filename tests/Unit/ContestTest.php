<?php

namespace Tests\Unit;

use App\Models\Contest;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ContestTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_get_contest_contestants()
    {
        // Arrange.
        $user = User::factory()->create();
        $contest = $user->contests()->save(Contest::factory()->make());

        // Act.
        $users = User::factory()->count(3)->create()->each(function(User $user)  use ($contest){
            $contest->submissions()->save(Submission::factory()->make(['user_id' => $user->id]));
        });

        // Assert.
        $this->assertEquals($users->pluck('id'), $contest->contestants->pluck('id'));
    }
}
