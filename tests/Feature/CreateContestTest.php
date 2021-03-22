<?php

namespace Tests\Feature;

use App\Http\Middleware\DatabaseTransaction;
use App\Models\Contest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateContestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test is the user is redirected to the next step.
     */
    public function test_user_is_redirected_to_checkout_create_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contests.store'), [
            'title' => 'A test contest',
            'description' => 'A nice story',
            'category' => 'packaging',
            'expires_at' => 1
        ]);

        $response->assertRedirect(route('checkout.create'));
    }

    /**
     * Test if the session data is stored between contest creation steps.
     */
    public function test_contest_session_contains_all_keys()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contests.store'), [
            'title' => 'A test contest',
            'description' => 'A nice story',
            'category' => 'packaging',
            'expires_at' => 1
        ]);

        $response->assertSessionHasAll([
            'contest.category',
            'contest.description',
            'contest.expires_at',
            'contest.title',
        ]);
    }

    /**
     * Test if the contest expires_at date is parsed to a Carbon instance.
     */
    public function test_contest_expires_at_date_is_carbon_instance()
    {
        $this->withoutMiddleware(DatabaseTransaction::class);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contests.store'), [
            'title' => 'A test contest',
            'description' => 'A nice story',
            'category' => 'packaging',
            'expires_at' => 1
        ]);

        $response->assertRedirect(route('checkout.create'));

        $this->post(route('checkout.store'), [
            'amount' => 150000,
            'currency' => 'EUR',
        ]);

        $expiresAt = Contest::latest()->first()->expires_at;

        $this->assertInstanceOf(Carbon::class, $expiresAt);
    }

    /**
     * Test if the contest expires_at date is set to the correct week.
     */
    public function test_contest_expires_at_date_calculates_correct_week_offset()
    {
        $this->withoutMiddleware(DatabaseTransaction::class);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contests.store'), [
            'title' => 'A test contest',
            'description' => 'A nice story',
            'category' => 'packaging',
            'expires_at' => 1
        ]);

        $response->assertRedirect(route('checkout.create'));

        $this->post(route('checkout.store'), [
            'amount' => 150000,
            'currency' => 'EUR',
        ]);

        /** @var Carbon $expiresAt */
        $expiresAt = Contest::latest()->first()->expires_at;

        $this->assertTrue($expiresAt->isNextWeek());
    }
}
