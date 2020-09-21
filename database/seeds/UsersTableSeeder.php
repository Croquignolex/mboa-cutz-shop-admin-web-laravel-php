<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::where('type', Role::SUPER_ADMIN)->first()->users()->create([
            'password' => 'k@lonayA10',
            'is_confirmed' => true,
            'phone' => '(+237) 673848464',
            'last_name' => 'NGOMBOL',
            'first_name' => 'Alex Stéphane',
            'email' => 'angombol@mboacutz.com',
        ]);

        Role::where('type', Role::ADMIN)->first()->users()->create([
            'password' => '000000',
            'is_confirmed' => true,
            'last_name' => 'TEST',
            'first_name' => 'Admin',
            'email' => 'atest@mboacutz.com',
        ]);

        Role::where('type', Role::USER)->first()->users()->create([
            'password' => '000000',
            'is_confirmed' => true,
            'last_name' => 'TEST',
            'first_name' => 'User',
            'email' => 'utest@mboacutz.com',
        ]);
    }
}