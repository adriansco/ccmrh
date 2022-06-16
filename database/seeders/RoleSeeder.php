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
        $roleadm = Role::create(['name' => 'Admin']);
        $roleusr = Role::create(['name' => 'User']);

        Permission::create(['name' => 'dashboard.index'])->syncRoles([$roleadm, $roleusr]);

        Permission::create(['name' => 'employees.index'])->syncRoles([$roleadm, $roleusr]);
        Permission::create(['name' => 'employees.create'])->syncRoles([$roleadm, $roleusr]);
        Permission::create(['name' => 'employees.edit'])->syncRoles([$roleadm, $roleusr]);
        Permission::create(['name' => 'employees.destroy'])->syncRoles([$roleadm, $roleusr]);
    }
}
