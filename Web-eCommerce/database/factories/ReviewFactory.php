<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'stars' => $faker->numberBetween($min = 1, $max = 5) ,
        'text' => $faker->text($maxNbChars = 200) ,
        
        'user_id' => $faker->numberBetween($min = 1, $max = 500) ,
        'product_type_id' => $faker->numberBetween($min = 1, $max = 66) ,
    ];
});
