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
        factory(Product::class, 20)->create()->each(function ($product) {
            $category = Category::where('name', '=', 'homme')->first();
            $product->category()->associate($category);
            $product->save();
        });
    }
}
