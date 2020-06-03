<?php

use App\Category;
use App\Picture;
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
        $this->call(CategorySeeder::class);

        foreach (scandir($defaultImages) as $directory) {
            if ($directory != '.' && $directory != '..') {
                foreach (scandir($defaultImages . '/' . $directory) as $file) {
                    if ($file != '.' && $file != '..') {
                        copy($defaultImages . $directory . '/' . $file, $storage . $directory . '/' . $file);

                        $picture = factory(Picture::class)->create();
                        $picture->name = explode('.', $file)[0];
                        $picture->link = $file;
                        $category = Category::where('name', '=', $directory)->first();
                        $picture->category()->associate($category);
                        $picture->save();
                    }
                }
            }
        }
    }
}
