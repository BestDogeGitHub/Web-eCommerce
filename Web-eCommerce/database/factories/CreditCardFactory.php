<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    return [
        'type' => $faker->creditCardType ,
        'number' => $faker->creditCardNumber ,
        'expiration_date' => $faker->creditCardExpirationDateString ,
    ];
});
