<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'degree' => 'MBBS',
        'doc_type' => $faker->numberBetween(1, 5),
        'doc_bmdc_no' => $faker->randomDigit,
        'gender' => 'male',
        'email' => $faker->unique()->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'district_id' => 3,
        'division_id' => $faker->numberBetween(26, 38),
        'thana_id' => $faker->numberBetween(227, 276), /* only Dhaka district*/
        'image' => $faker->imageUrl(),
        'd_b_status' => 1,
        'status' => 1,
        'fees' => floatval($faker->randomElement([500, 1000, 1500, 2000])),
        'second_fees' => floatval($faker->randomElement([200, 300, 400, 450])),
    ];
});
