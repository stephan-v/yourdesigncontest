<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payout;
use Faker\Generator as Faker;

$factory->define(Payout::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(200, 1500) * 100,
        'currency' => $faker->randomElement(['EUR', 'USD']),
        'status' => Payout::PENDING,
        'contest_id' => 1,
        'user_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
