<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'email' => $faker->email,
        'image' => $faker->url,
        'created_at' => Carbon\Carbon::today(),
    ];
});
