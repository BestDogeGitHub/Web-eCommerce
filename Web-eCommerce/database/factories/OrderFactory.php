<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'PO_Number' => $faker->numerify('#########'),
        'invoice_id' => $faker->unique()->numberBetween($min = 1, $max = 2000) ,
        'shipment_id' => $faker->unique()->numberBetween($min = 1, $max = 2000) ,
        'user_id' => $faker->numberBetween($min = 1, $max = 500) ,
    ];
});
