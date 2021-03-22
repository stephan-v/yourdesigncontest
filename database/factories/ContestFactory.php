<?php

namespace Database\Factories;

use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'category' => $this->faker->randomElement(['branding', 'webdesign', 'packaging']),
            'description' => $this->faker->text,
            'user_id' => 1,
            'expires_at' => now()->addWeeks($this->faker->numberBetween(1, 4)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the contest is finished.
     *
     * @return Factory
     */
    public function finished()
    {
        return $this->state(function () {
            return [
                'expires_at' => now(),
            ];
        });
    }
}
