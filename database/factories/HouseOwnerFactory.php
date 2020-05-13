<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\HouseOwner;
use Faker\Generator as Faker;

$factory->define(HouseOwner::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name(),
        'sex' => rand(0,1),
        'age' => rand(30, 60),
        'phone' => $faker->phoneNumber,

        'card' => $faker->creditCardNumber,
        'address' => $faker->address,
        // 'pic' => bcrypt('abc'),
        'email' => $faker->email,


    ];
});
