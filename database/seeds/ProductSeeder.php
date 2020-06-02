<?php

use App\Picture;
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
        $this->call(PictureSeeder::class);
        $pictures = Picture::all();
        foreach ($pictures as $picture) {
            $product = factory(Product::class)->create();
            $product->category()->associate($picture->category);
            $picture->product()->associate($product);
            $product->save();
        }
    }
}
