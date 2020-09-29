<?php

use App\Models\Category;
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
        Category::create(['fr_name' => 'Locale', 'en_name' => 'Local']);
        Category::create(['fr_name' => 'Globale', 'en_name' => 'Global']);
    }
}
