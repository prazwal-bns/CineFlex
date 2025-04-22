<?php

namespace Database\Seeders;

use App\Models\Theater;
use App\Models\User;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    public function run(): void
    {
        $theaters = [
            [
                'name' => 'CineFlex Premium',
                'address' => '123 Cinema Street, Kathmandu',
                'city' => 'Kathmandu',
                'manager_id' => User::where('email', 'manager@cineflex.com')->first()->id,
            ],
            [
                'name' => 'CineFlex Classic',
                'address' => '456 Movie Avenue, Lalitpur',
                'city' => 'Lalitpur',
                'manager_id' => User::where('email', 'manager2@cineflex.com')->first()->id,
            ],
            [
                'name' => 'CineFlex IMAX',
                'address' => '789 Theater Road, Bhaktapur',
                'city' => 'Bhaktapur',
                'manager_id' => User::where('email', 'manager3@cineflex.com')->first()->id,
            ],
        ];

        foreach ($theaters as $theater) {
            Theater::create($theater);
        }
    }
} 