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
        Category::create($this->getRowData());
        Category::create($this->getRowData());
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'description' => Lorem::text(),
            'fr_name' => Lorem::words(2),
            'en_name' => Lorem::words(2),
        ];
    }
}
