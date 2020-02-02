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

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'text' => $faker->realText($maxNbChars = 30, $indexSize = 3),
        'user_id' =>  $faker->numberBetween($min = 1, $max = 19),
        'review_id' =>  $faker->numberBetween($min = 1, $max = 5),
    ];
});
