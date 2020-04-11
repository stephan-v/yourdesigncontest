<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserPresenterTest extends TestCase
{
    use DatabaseMigrations;

    public function test_stripe_verified_attribute_is_false()
    {
        // Arrange.
        $user = factory(User::class)->create();

        // Act.
        $isStripeVerified = $user->isStripeVerified;

        // Assert.
        $this->assertfalse($isStripeVerified);
    }

    public function test_stripe_verified_attribute_is_true()
    {
        // Arrange.
        $user = factory(User::class)->create(['stripe_connect_id' => 'stripe_test_id']);

        // Act.
        $isStripeVerified = $user->isStripeVerified;

        // Assert.
        $this->assertTrue($isStripeVerified);
    }
}
