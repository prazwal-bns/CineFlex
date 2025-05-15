<?php

namespace Database\Seeders;

use App\Models\User;
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

        // Create theater managers
        $theaterManagers = [
            [
                'name' => 'Premium Theater Manager',
                'email' => 'manager@cineflex.com',
                'password' => '@manager123',
                'avatar' => 'manager1.jpg',
                'phone' => '+977 9812345678',
                'address' => 'Kathmandu, Nepal',
            ],
            [
                'name' => 'Classic Theater Manager',
                'email' => 'manager2@cineflex.com',
                'password' => '@manager123',
                'avatar' => 'manager2.jpg',
                'phone' => '+977 9823456789',
                'address' => 'Lalitpur, Nepal',
            ],
            [
                'name' => 'IMAX Theater Manager',
                'email' => 'manager3@cineflex.com',
                'password' => '@manager123',
                'avatar' => 'manager3.jpg',
                'phone' => '+977 9834567890',
                'address' => 'Bhaktapur, Nepal',
            ],
        ];

        foreach ($theaterManagers as $manager) {
            $user = User::firstOrCreate([
                'email' => $manager['email'],
            ], $manager);

            $user->assignRole('theater_manager');
        }

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
