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
        Product::first()->tags()->createMany([
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
        ]);

        Service::first()->tags()->createMany([
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
        ]);

        Article::first()->tags()->createMany([
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'description' => Lorem::text()
            ],
        ]);
    }
}
