<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(200, 1500) * 100,
        'currency' => $faker->randomElement(['EUR', 'USD']),
        'payment_id' => $faker->regexify('[A-Za-z0-9]{10}'),
        'fee' => $faker->numberBetween(20, 150) * 100,
        'user_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
