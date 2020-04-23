<?php

namespace Tests\Unit;

use App\Contest;
use App\Payout;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Money\Currency;
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

    public function test_can_calculate_total_pending_payout_correctly()
    {
        // Arrange.
        app()->singleton(Currency::class, function() {
            return new Currency('USD');
        });

        $user = factory(User::class)->create();
        $contest = factory(Contest::class)->create();

        $amountA = 300000;
        $amountB = 500000;

        $contest->payout()->saveMany([
            factory(Payout::class)->make(['amount' => $amountA, 'user_id' => $user->id]),
            factory(Payout::class)->make(['amount' => $amountB, 'user_id' => $user->id]),
        ]);

        // Act.
        $total = $user->totalPayoutAmount->getAmount();

        // Assert.
        $this->assertEquals($total, ($amountA + $amountB));
    }
}
