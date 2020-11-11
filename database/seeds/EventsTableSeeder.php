<?php

use App\Models\Event;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'fr_name' => Lorem::word(),
            'en_name' => Lorem::word(),
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
        ]);

        Event::create([
            'fr_name' => Lorem::word(),
            'en_name' => Lorem::word(),
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
        ]);
    }
}
