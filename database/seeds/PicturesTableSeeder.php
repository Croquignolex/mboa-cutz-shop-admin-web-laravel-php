<?php

use App\Models\Picture;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Picture::create($this->getRowData());
        Picture::create($this->getRowData());
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'fr_description' => Lorem::text(),
            'en_description' => Lorem::text(),
        ];
    }
}
