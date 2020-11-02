<?php

use Faker\Provider\Lorem;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::create([
                'name' => Lorem::sentence(2),
                'fr_description' => Lorem::text(),
                'en_description' => Lorem::text()
        ]);

        Testimonial::create([
            'name' => Lorem::sentence(2),
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text()
        ]);
    }
}
