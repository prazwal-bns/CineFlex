<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => '@admin123',
        ]);

        $admin->assignRole('super_admin');

        $theaterManager = User::firstOrCreate([
            'name' => 'Theater Manager User',
            'email' => 'theater_manager@gmail.com',
            'password' => '@user123',
        ]);

        $theaterManager->assignRole('theater_manager');

        $customer = User::firstOrCreate([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => '@user123',
        ]);

        $customer->assignRole('customer');
    }
}
