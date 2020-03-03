<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'details' => $faker->text($maxNbChars = 200),
        'payment' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'payment_method_id' => $faker->numberBetween($min = 1, $max = 3)
    ];
});
