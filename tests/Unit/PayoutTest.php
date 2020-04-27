<?php

namespace Tests\Unit;

use App\Contest;
use App\Jobs\TransferFunds;
use App\Payout;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class PayoutTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_initiate_a_user_payout()
    {
        Bus::fake();

        // Arrange.
        $user = factory(User::class)->create([
            'stripe_connect_id' => 'test'
        ]);

        $contest = $user->contests()->save(factory(Contest::class)->make());

        // Act.
        $contest->payout()->save(factory(Payout::class)->make(['user_id' => $user->id]));

        $user->createPayout();

        // Assert.
        Bus::assertDispatched(TransferFunds::class);
    }
}
