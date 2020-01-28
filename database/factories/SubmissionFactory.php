<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Submission;
use Faker\Generator as Faker;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'path' => 'submissions/1/a6G50uLhxZbfadWjiBQZimG2evHtuF3esG40QuAY.png',
        'contest_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
