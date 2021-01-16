<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'currency' => $this->faker->randomElement(['EUR', 'USD']),
            'email_verified_at' => now(),
            'password' => bcrypt('test'),
            'api_token' => Str::random(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the user is a test user.
     *
     * @return Factory
     */
    public function tester()
    {
        return $this->state(function () {
            return [
                'email' => 'account@yourdesigncontest.test',
            ];
        });
    }
}
