<?php

use App\Models\Product;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ProductReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::first()->reviews()->createMany([
            ['description' => Lorem::text()],
            ['description' => Lorem::text()]
        ]);
    }
}
