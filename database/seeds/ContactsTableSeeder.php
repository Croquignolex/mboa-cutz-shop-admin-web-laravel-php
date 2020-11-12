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
        Contact::create($this->getRowData());
        Contact::create($this->getRowData());
    }

    /**
     * @return array
     */
    private function getRowData()
    {
        return [
            'email' => Lorem::word(),
            'phone' => Lorem::word(),
            'message' => Lorem::text(),
            'name' => Lorem::words(2, true),
            'subject' => Lorem::words(3, true),
        ];
    }
}
