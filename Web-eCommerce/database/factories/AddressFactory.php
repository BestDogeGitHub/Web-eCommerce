<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'building_number' => $faker->buildingNumber ,
        'street_number' => $faker->numberBetween($min = 1, $max = 500) ,
        'postcode' => $faker->postcode ,
        'country_code' => $faker->stateAbbr ,
        'town_id' => $faker->numberBetween($min = 1, $max = 200)
        
    ];
});
