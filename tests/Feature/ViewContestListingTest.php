<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewContestListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_a_contest_listing()
    {
        // Arrange
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'currency' => 'EUR',
        ]);

        $contest = $user->contests()->create([
            'category' => 'branding',
            'description' => 'Description',
            'name' => 'A custom name',
            'expires_at' => (new Carbon())->addWeeks(1),
            'status' => 'online',
        ]);

        // Act.
        $response = $this->get('/contests/' . $contest->id);

        // Assert.
        $response->assertSee('A custom name');
        $response->assertSee('Description');
    }
}
