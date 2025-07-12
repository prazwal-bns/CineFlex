<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ShieldSeeder::class,
            UserSeeder::class,
            TheaterSeeder::class,
            ScreenSeeder::class,
            SeatSeeder::class,
            MovieSeeder::class,
            ShowtimeSeeder::class,
            CouponSeeder::class,
        ]);
    }
}
