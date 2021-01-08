<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(200, 1500) * 100,
            'currency' => $this->faker->randomElement(['EUR', 'USD']),
            'payment_id' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'fee' => $this->faker->numberBetween(20, 150) * 100,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
