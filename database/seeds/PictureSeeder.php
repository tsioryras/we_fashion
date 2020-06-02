<?php

use App\Category;
use App\Picture;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('local')->delete(Storage::allFiles());
        $storage = storage_path('app/public/img/products/');
        $defaultImages = storage_path('defaultImages/');
        $picturesFiles = [];

        foreach (scandir($defaultImages) as $directory) {
            if ($directory != '.' && $directory != '..') {
                foreach (scandir($defaultImages . '/' . $directory) as $file) {
                    if ($file != '.' && $file != '..') {
                        copy($defaultImages . $directory . '/' . $file, $storage . $directory . '/' . $file);
                        $picturesFiles[] = ['name' => explode('.', $file)[0], 'link' => $file, 'category' => $directory];
                    }
                }
            }
        }

        $products = Product::all()->all();
        shuffle($products);
        factory(Picture::class, 20)->create()->each(function ($picture, $products) {

        });
    }
}
