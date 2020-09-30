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
            'name' => Lorem::words(2),
            'fr_description' => Lorem::sentence(),
            'en_description' => Lorem::sentence()
        ]);

        Testimonial::create([
            'name' => Lorem::words(2),
            'fr_description' => Lorem::sentence(),
            'en_description' => Lorem::sentence()
        ]);

        Testimonial::create([
            'name' => Lorem::words(2),
            'fr_description' => Lorem::sentence(),
            'en_description' => Lorem::sentence()
        ]);

        Testimonial::create([
            'name' => Lorem::words(2),
            'fr_description' => Lorem::sentence(),
            'en_description' => Lorem::sentence()
        ]);
    }
}
