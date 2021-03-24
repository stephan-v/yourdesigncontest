<?php

namespace Tests\Feature;

use App\Models\Contest;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewContestTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_view_a_contest()
    {
        // Arrange
        $user = User::factory()->create();

        $contest = $user->contests()->create([
            'category' => 'branding',
            'description' => 'Description',
            'title' => 'A custom name',
            'expires_at' => (new Carbon())->addWeeks(1),
        ]);

        $contest->payment()->save(
            Payment::factory()->make()
        );

        // Act.
        $response = $this->get(route('contests.show', $contest));

        // Assert.
        $response->assertSee('A custom name');
        $response->assertSee('Description');
    }

    public function test_user_cannot_view_an_unpaid_contest()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Arrange
        $contest = $user->contests()->save(
            Contest::factory()->make()
        );

        // Act.
        $response = $this->get(route('contests.show', $contest));

        // Assert.
        $response->assertRedirect('/');
    }
}
