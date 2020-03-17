<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductType;
use Faker\Generator as Faker;

$factory->define(ProductType::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'image_ref'=> '/images/products/product-' . $faker->numberBetween($min = 1, $max = 10) . '.jpg',
        'available' => 1,
        'star_tot_number' => $faker->numberBetween($min = 0, $max = 50),
        'n_reviews' => $faker->numberBetween($min = 0, $max = 10),
        'producer_id' => $faker->numberBetween($min = 1, $max = 7),
    ];
});
