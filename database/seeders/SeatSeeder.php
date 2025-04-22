<?php

namespace Database\Seeders;

use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $screens = Screen::all();

        foreach ($screens as $screen) {
            $capacity = $screen->capacity;
            
            // Calculate rows and seats per row based on capacity
            // Using a ratio of approximately 1:1.5 for rows to seats
            $rows = ceil(sqrt($capacity / 1.5));
            $seatsPerRow = ceil($capacity / $rows);

            // Generate seats
            for ($row = 0; $row < $rows; $row++) {
                $rowLetter = chr(65 + $row); // Convert 0 to 'A', 1 to 'B', etc.
                
                for ($seatNumber = 1; $seatNumber <= $seatsPerRow; $seatNumber++) {
                    // Skip some seats to create aisle gaps
                    if ($seatNumber % 5 === 0) {
                        continue;
                    }

                    Seat::create([
                        'screen_id' => $screen->id,
                        'row' => $rowLetter,
                        'number' => $seatNumber,
                    ]);
                }
            }
        }
    }
} 