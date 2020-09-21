<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'fr_name' => 'Locale',
            'en_name' => 'Local'
        ]);

        ProductCategory::create([
            'fr_name' => 'Globale',
            'en_name' => 'Global'
        ]);
    }
}
