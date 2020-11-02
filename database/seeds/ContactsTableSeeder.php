<?php

use App\Models\Contact;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
                'name' => Lorem::word(),
                'email' => Lorem::word(),
                'phone' => Lorem::word(),
                'subject' => Lorem::word(),
                'message' => Lorem::text(),
        ]);

        Contact::create([
            'name' => Lorem::word(),
            'email' => Lorem::word(),
            'phone' => Lorem::word(),
            'subject' => Lorem::word(),
            'message' => Lorem::text(),
        ]);
    }
}
