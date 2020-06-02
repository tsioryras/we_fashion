<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $status = ['unpublished', 'publish'];
    $size = ['XS', 'S', 'M', 'L', 'XL'];
    $code = ['standard', 'onSale'];

    $statusIndex = rand(0, 2);
    $sizeIndex = rand(0, 4);
    $codeIndex = rand(0, 1);

    $date = ($statusIndex == 0) ? null : $faker->dateTime;
    $price = $faker->randomFloat(2, 0, 1000);

    return [
        'name' => $faker->userName,
        'description' => $faker->paragraph(5),
        'status' => $status[$statusIndex],
        'code' => $code[$codeIndex],
        'size' => $size[$sizeIndex],
        'reference' => $faker->isbn10,
        'price' => $price,
        'published_at' => $date
    ];
});
