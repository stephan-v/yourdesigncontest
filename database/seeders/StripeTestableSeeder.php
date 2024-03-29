<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Payment;
use App\Models\Submission;
use Illuminate\Database\Seeder;
use Money\Currency;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

/**
 * @TODO remove this out of the default seeder flow when done testing.
 */
class StripeTestableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws ApiErrorException Thrown if there is a Stripe API error.
     */
    public function run()
    {
        // Set the currency because the service is not instantiated in a seeder.
        app()->singleton(Currency::class, function() {
            return new Currency('EUR');
        });

        // Contest which has an actual Stripe payment to test.
        $contest = Contest::factory()->create([
            'title' => 'Stripe testable',
            'expires_at'=> now()->addDays(3),
            'user_id' => 1,
        ]);

        // Crate the Stripe customer.
        $customer = Customer::create([
            'email' => $contest->user->email,
        ]);

        // Create a payment intent to mimic a paid contest.
        $paymentIntent = PaymentIntent::create([
            'amount' => 20000,
            'currency' => 'eur',
            'payment_method' => 'pm_card_bypassPending',
            'confirm' => true,
            'customer' => $customer->id,
            'metadata' => [
                'contest_id' => $contest->id,
            ]
        ]);

        // Create the contest locally with the Stripe payment id.
        $contest->payment()->save(Payment::factory()->make([
            'amount' => $paymentIntent['amount'],
            'payment_id' => $paymentIntent->id,
        ]));

        // Create a winning submission for the stripe testable.
        Submission::factory()->create([
            'user_id' => 1,
            'contest_id' => $contest->id,
            'winner' => true,
        ]);
    }
}
