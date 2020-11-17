<?php

use App\Models\Category;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::first()->services()->createMany([$this->getRowData(), $this->getRowData()]);
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
            'fr_name' => Lorem::words(2, true),
            'en_name' => Lorem::words(2, true),
        ];
    }
}
