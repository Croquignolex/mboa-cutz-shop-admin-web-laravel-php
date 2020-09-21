<?php

use App\Models\ProductCategory;
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
        ProductCategory::find(1)->create([
            'fr_name' => 'Mousse à raser',
            'en_name' => 'Shaving cream',
            'price' => 3000,
            'stock' => 10,
        ]);

        ProductCategory::find(2)->create([
            'fr_name' => 'Poudre à raser',
            'en_name' => 'Shaving powder',
            'price' => 2000,
            'stock' => 10,
        ]);
    }
}
