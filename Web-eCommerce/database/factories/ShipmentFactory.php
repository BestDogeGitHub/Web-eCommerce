<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipment;
use Faker\Generator as Faker;

$factory->define(Shipment::class, function (Faker $faker) {
    static $shipOrder = 1;
    return [
            'tracking_number' => $faker->numerify('#########') ,
            'delivery_date' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Europe/Rome')->format('Y-m-d'),
            'address_id' => $faker->numberBetween($min = 1, $max = 1500),
            'carrier_id' => $faker->numberBetween($min = 1, $max = 6),
            'order_id' => $shipOrder++,
            'delivery_status_id' => 7,
    ];
});
