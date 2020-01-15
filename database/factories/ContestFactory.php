<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contest;
use Faker\Generator as Faker;

$factory->define(Contest::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'status' => 'online',
        'user_id' => 1,
        'expires_at' => now()->addWeeks(1),
    ];
});
