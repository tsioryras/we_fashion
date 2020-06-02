<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Picture;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


$factory->define(Picture::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'link' => Hash::make($faker->password)
    ];
});
