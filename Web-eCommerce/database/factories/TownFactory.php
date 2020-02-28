<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Town;
use Faker\Generator as Faker;

$factory->define(Town::class, function (Faker $faker) {
    return [
        /*'user_role_id' => 1,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'matric_no' => $faker->bothify('######'),
        'email' => $faker->unique()->safeEmail,
        'personal_calendar' => 0,
        'LAU' => now(),
        'email_verified_at' => now(),
        'password' => $faker->word, // password
        'remember_token' => Str::random(10),*/

        'name' => $faker->city, 
        'nation_id' => $faker-> numberBetween($min = 1, $max = 50),
    ];
});
