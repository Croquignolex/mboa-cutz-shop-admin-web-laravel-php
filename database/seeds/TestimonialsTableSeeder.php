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
        Testimonial::create($this->getRowData());
        Testimonial::create($this->getRowData());
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
            'name' => Lorem::sentence(2),
        ];
    }
}
