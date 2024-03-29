<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_owner_can_view_user_settings()
    {
        // Arrange.
        $owner = User::factory()->create();

        // Act.
        $this->actingAs($owner);
        $response = $this->get(route('users.edit', $owner));

        // Assert.
        $response->assertOk();
    }

    public function test_outsider_cannot_view_user_settings()
    {
        // Arrange.
        $owner = User::factory()->create();
        $user = User::factory()->create();

        // Act.
        $this->actingAs($user);
        $response = $this->get(route('users.edit', $owner));

        // Assert.
        $response->assertForbidden();
    }
}
