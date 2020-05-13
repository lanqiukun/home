<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\House;
use Faker\Generator as Faker;

use App\Models\Region;

$factory->define(House::class, function (Faker $faker) {

    $all_region = Region::pluck('code')->toArray();


    

    return [
        //
        'name' => substr($faker->text, 0, 40),
        'area' => $faker->word,
        'region' => $all_region[rand(0, Region::count() - 1)],
        'addr' => $faker->address,
        'towards' => [21, 22, 23, 24 ,25, 28 ,29, 30, 31][rand(0, 8)],
        'building_area' => rand(2, 200),
        'available_area' => rand(2, 200),
        'built' => rand(1900, 2020),
        'rpm' => rand(1, 100000000),
        'floor' => rand(-10, 127),
        'bedroom' => rand(0, 100),
        'hall' => rand(0, 100),
        'bathroom' => rand(0, 100),
        'position' => rand(1, 5),
        'status' => rand(0, 20),
        'houseowner' => rand(1, 100),
        'desc' => substr($faker->text, 0, 40),
        'info' => $faker->text,
        'housegroup' => rand(0, 10),
        'recommend' => rand(0, 1),
        'long' => 0,
        'lat' => 0,




    ];
});
