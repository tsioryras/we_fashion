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
        $category = ['homme', 'femme'];
        for ($i = 0; $i < sizeof($category); $i++) {
            factory(Category::class)->create(
                [
                    'name' => $category[$i],
                ]
            );
        }
    }
}
