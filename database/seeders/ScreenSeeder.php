<?php

namespace Database\Seeders;

use App\Models\Screen;
use App\Models\Theater;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    public function run(): void
    {
        $theaters = Theater::all();

        foreach ($theaters as $theater) {
            // Premium theater has 3 screens
            if ($theater->name === 'CineFlex Premium') {
                $screens = [
                    ['name' => 'Screen 1 - IMAX', 'capacity' => 100],
                    ['name' => 'Screen 2 - Premium', 'capacity' => 80],
                    ['name' => 'Screen 3 - Standard', 'capacity' => 60],
                ];
            }
            // Classic theater has 2 screens
            elseif ($theater->name === 'CineFlex Classic') {
                $screens = [
                    ['name' => 'Screen 1 - Standard', 'capacity' => 60],
                    ['name' => 'Screen 2 - Standard', 'capacity' => 60],
                ];
            }
            // IMAX theater has 2 screens
            else {
                $screens = [
                    ['name' => 'Screen 1 - IMAX', 'capacity' => 100],
                    ['name' => 'Screen 2 - Premium', 'capacity' => 80],
                ];
            }

            foreach ($screens as $screen) {
                Screen::create([
                    'theater_id' => $theater->id,
                    'name' => $screen['name'],
                    'capacity' => $screen['capacity'],
                ]);
            }
        }
    }
} 