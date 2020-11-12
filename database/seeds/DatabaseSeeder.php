<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);

        $this->call(TagsTableSeeder::class);

        $this->call(ProductReviewsTableSeeder::class);
        $this->call(ServiceReviewsTableSeeder::class);
        $this->call(ArticleCommentsTableSeeder::class);
    }
}
