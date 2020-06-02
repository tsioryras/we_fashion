<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 80)->create()->each(function ($product) {
            $category = Category::find(rand(1, 2));

            $product->category()->associate($category);
            $product->save();
        });
    }
}
