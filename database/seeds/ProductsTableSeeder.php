<?php

use App\Models\Category;
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
        Category::first()->products()->create([
            'fr_name' => 'Mousse à raser',
            'en_name' => 'Shaving cream',
            'price' => 3000,
            'stock' => 10,
        ]);

        Category::first()->products()->create([
            'fr_name' => 'Poudre à raser',
            'en_name' => 'Shaving powder',
            'price' => 2000,
            'stock' => 10,
        ]);
    }
}
