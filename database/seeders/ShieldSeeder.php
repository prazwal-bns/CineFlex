<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ShieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::pluck('name')->toArray();

        // Create the roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $theaterManagerRole = Role::firstOrCreate(['name' => 'theater_manager']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Assign ALL permissions to super_admin
        $superAdminRole->syncPermissions($permissions);


    }
}
