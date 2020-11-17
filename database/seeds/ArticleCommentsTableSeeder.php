<?php

use App\Models\Article;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ArticleCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::first()->comments()->createMany([$this->getRowData(), $this->getRowData()]);
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return ['description' => Lorem::text()];
    }
}
