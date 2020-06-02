<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $status = ['unpublished', 'publish'];
    $size = ['XS', 'S', 'M', 'L', 'XL'];
    $code = ['standard', 'onSale'];

    $statusIndex = rand(0, 2);
    $date = ($statusIndex == 0) ? null : $faker->dateTime;

    return [
        'name' => $faker->userName,
        'description' => $faker->paragraph(5),
        'status' => $status[$statusIndex],
        'code' => $faker->randomElement($code),
        'size' => $faker->randomElement($size),
        'reference' => $faker->isbn10,
        'price' => $faker->randomFloat(2, 0, 1000),
        'published_at' => $date
    ];
});
