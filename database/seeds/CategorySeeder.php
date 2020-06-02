<?php

use App\User;
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
        factory(User::class)->create(['name' => 'homme',]);
        factory(User::class)->create(['name' => 'femme',]);
    }
}
