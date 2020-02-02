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

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'comment' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'evaluation' =>  $faker->numberBetween($min = 1, $max = 10),
        'user_id' =>  $faker->numberBetween($min = 1, $max = 19),
        'client_id' =>  $faker->numberBetween($min = 1, $max = 4),
    ];
});
