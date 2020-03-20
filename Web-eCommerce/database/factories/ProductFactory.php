<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'payment' => $faker->numberBetween($min = 1, $max = 2000) ,
        'sale' => $faker->numberBetween($min = 1, $max = 50) ,
        'stock' => $faker->numberBetween($min = 1, $max = 100) ,
        'buy_counter' => $faker->numberBetween($min = 1, $max = 100) ,
        'available' => 1 ,
        'info' => $faker->text,
        'product_type_id' => $faker->numberBetween($min = 1, $max = 64),
        'iva_category_id' => 1
    ];
});
