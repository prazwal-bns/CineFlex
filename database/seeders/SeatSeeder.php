<?php

namespace Database\Seeders;

use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $screens = Screen::whereDoesntHave('seats')->get();

        foreach ($screens as $screen) {
            $rows = range('A', 'J');
            $seatsPerRow = 10;
            $totalSeats = 0;

            foreach ($rows as $row) {
                for ($number = 1; $number <= $seatsPerRow; $number++) {
                    if ($totalSeats >= $screen->capacity) {
                        break 2;
                    }

                    Seat::create([
                        'screen_id' => $screen->id,
                        'row' => $row,
                        'number' => $number,
                    ]);

                    $totalSeats++;
                }
            }
        }
    }
} 