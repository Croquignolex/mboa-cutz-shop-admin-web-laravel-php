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
     * @throws ReflectionException
     */
    public function run()
    {
        foreach (UserRole::getList() as $type) {
            Role::create(compact('type'));
        }
    }
}