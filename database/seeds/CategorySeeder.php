<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['homme', 'femme', 'autre'];
        for ($i = 0; $i < sizeof($category); $i++) {
            factory(Category::class)->create(
                [
                    'name' => $category[$i],
                ]
            );
            $folder = public_path('storage/img/products/' . $category[$i]);
            if (!file_exists($folder)) {
                mkdir(public_path('storage/img/products/' . $category[$i]));
            }
        }
    }
}
