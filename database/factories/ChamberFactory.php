<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Chamber;
use Faker\Generator as Faker;

$factory->define(Chamber::class, function (Faker $faker) {
    return [
        'chamber_name' => $faker->name,
        'chamber_address' => $faker->address,
        'division_id' => 3,
        'district_id' => $faker->numberBetween(26, 30),
        'thana_id' => $faker->numberBetween(227, 250), /* only Dhaka district*/
        'room_no' => $faker->numberBetween(1111,9999),
        'phone' => $faker->phoneNumber,
        'image' => null,
        'status' => 1,
    ];
});
