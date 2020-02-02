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

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'slug' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'logo' => 'aaynet_1551538152IJZm3OyrmXsGTM1.png',
        'location'  =>  'location',
        'user_id' =>  $faker->numberBetween($min = 1, $max = 19),
        'city_id' =>  1
    ];
});
