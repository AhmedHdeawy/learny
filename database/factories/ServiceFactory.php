<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'details' => $faker->realText($maxNbChars = 70, $indexSize = 5),
        'price' => $faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 9999999),
        'currency' => $faker->currencyCode,
        'client_id' =>  $faker->numberBetween($min = 1, $max = 5),
    ];
});
