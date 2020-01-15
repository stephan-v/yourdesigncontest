<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomNumber(4) * 100,
        'payment_id' => $faker->regexify('[A-Za-z0-9]{10}'),
    ];
});
