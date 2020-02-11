<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contest;
use Faker\Generator as Faker;

$factory->define(Contest::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->text,
        'status' => 'online',
        'user_id' => 1,
        'expires_at' => now()->addWeeks(1),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

$factory->state(Contest::class, 'finished', [
    'expires_at' => now(),
]);
