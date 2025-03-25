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
            'avatar' => 'admin.png',
            'phone' => '+977 9800000000',
            'address' => 'Kathmandu, Nepal',
        ]);

        $admin->assignRole('super_admin');

        $theaterManager = User::firstOrCreate([
            'name' => 'Theater Manager User',
            'email' => 'theater_manager@gmail.com',
            'password' => '@user123',
            'avatar' => 'theater_manager.jpg',
            'phone' => '+977 9878451254',
            'address' => 'Pokhara, Nepal',
        ]);

        $theaterManager->assignRole('theater_manager');

        $customer = User::firstOrCreate([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => '@user123',
            'avatar' => 'customer.jpg',
            'phone' => '+977 9874512547',
            'address' => 'Biratnagar, Nepal',
        ]);

        $customer->assignRole('customer');
    }
}
