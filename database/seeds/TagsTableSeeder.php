<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['fr_name' => 'Rouge', 'en_name' => 'Red']);
        Tag::create(['fr_name' => 'Blanc', 'en_name' => 'White']);
    }
}
