<?php

use App\Models\Category;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::first()->articles()->createMany([$this->getRowData(), $this->getRowData()]);
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return  [
            'fr_name' => Lorem::words(2),
            'en_name' => Lorem::words(2),
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
        ];
    }
}
