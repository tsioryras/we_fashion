<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;

$factory->define(Product::class, function () {
    $faker = Faker\Factory::create('fr_FR');
    $status = ['unpublished', 'published'];
    $size = ['XS', 'S', 'M', 'L', 'XL'];
    $code = ['standard', 'onSale'];
    $sizeNumber = rand(1, 5);
    $productSizes = [];
    for ($i = 0; $i < $sizeNumber; $i++) {
        $index = rand(0, 4);
        if (!in_array($size[$index], $productSizes)) {
            $productSizes[$index] = $size[$index];
        }
    }
    ksort($productSizes);
    $statusIndex = rand(0, 1);
    $date = ($statusIndex == 0) ? null : $faker->dateTime;

    return [
        'name' => $faker->jobTitle,
        'description' => $faker->paragraph(5),
        'status' => $status[$statusIndex],
        'code' => $code[rand(0, 1)],
        'size' => $productSizes,
        'reference' => $faker->isbn10,
        'price' => $faker->randomFloat(2, 50, 1000),
        'published_at' => $date
    ];
});
