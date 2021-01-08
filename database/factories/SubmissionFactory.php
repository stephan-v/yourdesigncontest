<?php

namespace Database\Factories;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'filename' => 'a6G50uLhxZbfadWjiBQZimG2evHtuF3esG40QuAY.png',
            'user_id' => User::all()->random()->id,
            'contest_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
