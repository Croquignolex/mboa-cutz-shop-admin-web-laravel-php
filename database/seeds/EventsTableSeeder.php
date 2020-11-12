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
        Event::create($this->getRowData());
        Event::create($this->getRowData());
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'started_at' => now(),
            'fr_name' => Lorem::words(2),
            'en_name' => Lorem::words(2),
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
            'localisation' => Lorem::words(3),
            'ended_at' => now()->addDays(3),
        ];
    }
}
