<?php

use App\Models\Role;
use App\Enums\UserRole;
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
        Role::where('type', UserRole::SUPER_ADMIN)->first()->users()->createMany([
            [
                'last_name' => 'NGOMBOL',
                'first_name' => 'Alex Stéphane',
                'email' => 'angombol@mboacutz.com',
            ],
            [
                'last_name' => 'TEST',
                'first_name' => 'Admin',
                'email' => 'atest@mboacutz.com',
            ],
            [
                'last_name' => 'TEST',
                'first_name' => 'User',
                'email' => 'utest@mboacutz.com',
            ]
        ]);
    }
}