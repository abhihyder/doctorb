<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->randomDigit(9999990,9999999),
        'organization_id' => $faker->numberBetween(1,9),
        'chamber_id' => $faker->numberBetween(1,9),
        'created_by' => 1,
    ];
    $faker->seed(5);
});
