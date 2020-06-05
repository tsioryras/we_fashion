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
            $id = random_int(1, 2);
            if (Product::where('category_id', '=', $id)->count() > 9) {
                $id = ($id == 1) ? 2 : 1;
            }
            $category = Category::find($id);
            $product->category()->associate($category);
            $product->save();
        });
    }
}
