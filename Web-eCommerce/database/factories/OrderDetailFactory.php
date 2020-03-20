<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween($min = 1, $max = 3) ,
        'order_id' => $faker->numberBetween($min = 1, $max = 500) ,
        'product_id' => $faker->numberBetween($min = 1, $max = 64) 
    ];
});
