<?php

use App\Models\Category;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'fr_name' => Lorem::word(),
            'en_name' => Lorem::word(),
            'description' => Lorem::sentence()
        ]);

        Category::create([
            'fr_name' => Lorem::word(),
            'en_name' => Lorem::word(),
            'description' => Lorem::sentence()
        ]);
    }
}
