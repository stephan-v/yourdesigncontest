<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Submission;
use App\User;
use Faker\Generator as Faker;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'filename' => 'a6G50uLhxZbfadWjiBQZimG2evHtuF3esG40QuAY.png',
        'user_id' => User::all()->random()->id,
        'contest_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
