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
        Category::first()->articles()->createMany([
            [
                'fr_title' => Lorem::word(),
                'en_title' => Lorem::word(),
                'fr_description' => Lorem::text(),
                'en_description' => Lorem::text(),
            ],
            [
                'fr_title' => Lorem::word(),
                'en_title' => Lorem::word(),
                'fr_description' => Lorem::text(),
                'en_description' => Lorem::text(),
            ]
        ]);
    }
}
