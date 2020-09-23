<?php

use App\Models\Role;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['type' => UserRole::USER]);
        Role::create(['type' => UserRole::ADMIN]);
        Role::create(['type' => UserRole::SUPER_ADMIN]);
    }
}