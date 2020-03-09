<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    static $cardOrder = 1;
    return [
        'type' => $faker->creditCardType ,
        'number' => $faker->creditCardNumber ,
        'expiration_date' => $faker->creditCardExpirationDateString ,
        'user_id' => $cardOrder++
    ];
});
