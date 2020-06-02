<?php

use App\Picture;
use App\Product;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all()->all();
        $count = sizeof($products) + 1;
        shuffle($products);
        factory(Picture::class, $count)->create()->each(function ($picture, $products) {
            $key = is_array($products) ? array_rand($products, 1) : null;
            $product = is_array($products) ? $products[$key] : $products;
            $picture->picture()->associate($product);
            $picture->save();
            unset($products[$key]);
        });
    }
}
