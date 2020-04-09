<?php

namespace Tests\Feature;

use App\Contest;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewContestTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_view_a_contest()
    {
        // Arrange
        $user = factory(User::class)->create();

        $contest = $user->contests()->create([
            'category' => 'branding',
            'description' => 'Description',
            'name' => 'A custom name',
            'expires_at' => (new Carbon())->addWeeks(1),
        ]);

        $contest->payment()->save(
            factory(Payment::class)->make()
        );

        // Act.
        $response = $this->get('/contests/' . $contest->id);

        // Assert.
        $response->assertSee('A custom name');
        $response->assertSee('Description');
    }

    public function test_user_cannot_view_an_unpaid_contest()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        // Arrange
        $contest = $user->contests()->save(
            factory(Contest::class)->make()
        );

        // Act.
        $response = $this->get('/contests/' . $contest->id);

        // Assert.
        $response->assertRedirect('/');
    }
}
