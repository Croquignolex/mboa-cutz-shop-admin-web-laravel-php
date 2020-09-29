<?php

use App\Models\Product;
use App\Models\Tag;
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
            ['fr_name' => 'Rouge', 'en_name' => 'Red'],
            ['fr_name' => 'Blanc', 'en_name' => 'White']
        ]);
    }
}
