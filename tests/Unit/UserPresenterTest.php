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
