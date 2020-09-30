<?php

use App\Models\Category;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::first()->products()->createMany(
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'fr_description' => Lorem::sentence(),
                'en_description' => Lorem::sentence(),
            ],
            [
                'fr_name' => Lorem::word(),
                'en_name' => Lorem::word(),
                'fr_description' => Lorem::sentence(),
                'en_description' => Lorem::sentence(),
            ]
        );
    }
}
