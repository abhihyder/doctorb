<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    return [
        'organization_name' => $faker->company,
        'organization_address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'image' => null,
        'registration_no' => $faker->buildingNumber,
        'division_id' => 3,
        'district_id' => $faker->numberBetween(26, 30),
        'thana_id' => $faker->numberBetween(227, 250), /* only Dhaka district*/
        'organization_type' => $faker->numberBetween(1, 5),
        'status' => 1,
        'zip_code' => $faker->areaCode,
    ];
});
