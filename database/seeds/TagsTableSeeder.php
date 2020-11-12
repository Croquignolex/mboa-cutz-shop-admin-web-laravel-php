<?php

use App\Models\Article;
use App\Models\Product;
use App\Models\Service;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::first()->tags()->createMany([$this->getRowData(), $this->getRowData()]);
        Service::first()->tags()->createMany([$this->getRowData(), $this->getRowData()]);
        Article::first()->tags()->createMany([$this->getRowData(), $this->getRowData()]);
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
