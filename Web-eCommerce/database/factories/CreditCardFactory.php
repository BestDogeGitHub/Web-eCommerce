<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    static $cardOrder = 1;
    return [
        'number' => $faker->creditCardNumber ,
        'expiration_date' => $faker->creditCardExpirationDateString ,
        'user_id' => $cardOrder++,
        'credit_card_company_id' => $faker->numberBetween($min = 1, $max = 16)
    ];
});
