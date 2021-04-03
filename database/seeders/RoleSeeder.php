<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'  => 'admin'])->givePermissionTo(['managers.*','receptionists.*','clients.*']);
        Role::create(['name'  => 'manager'])->givePermissionTo(['receptionists.*','clients.*']);
        Role::create(['name'  => 'receptionists'])->givePermissionTo(['clients.*']);
        Role::create(['name'  => 'client']);
    }
}
