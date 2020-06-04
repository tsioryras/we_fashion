<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        //10 produits de catégorie HOMME
        factory(Product::class, 10)->create()->each(function ($product) {
            $category = Category::where('name', '=', 'homme')->first();
            $product->category()->associate($category);
            $product->save();
        });
        //10 produits de catégorie FEMME
        factory(Product::class, 10)->create()->each(function ($product) {
            $category = Category::where('name', '=', 'femme')->first();
            $product->category()->associate($category);
            $product->save();
        });
    }
}
