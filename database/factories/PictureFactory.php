<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Picture;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

Storage::disk('local')->delete(Storage::allFiles());

$factory->define(Picture::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'link' => "#"
    ];
});
