<?php

use App\Models\Service;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ServiceReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::first()->reviews()->createMany([$this->getRowData(), $this->getRowData()]);
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return ['description' => Lorem::text()];
    }
}
