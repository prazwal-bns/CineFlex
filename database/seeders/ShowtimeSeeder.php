<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Screen;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShowtimeSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $screens = Screen::all();
        
        // Check if there are movies and screens available
        if ($movies->isEmpty()) {
            $this->command->warn('No movies found. Please run MovieSeeder first.');
            return;
        }
        
        if ($screens->isEmpty()) {
            $this->command->warn('No screens found. Please run ScreenSeeder first.');
            return;
        }
        
        // Generate showtimes for the next 7 days
        $startDate = Carbon::now()->startOfDay();
        
        for ($day = 0; $day < 7; $day++) {
            $currentDate = $startDate->copy()->addDays($day);
            
            foreach ($screens as $screen) {
                // Generate 4-6 showtimes per screen per day
                $showtimesCount = rand(4, 6);
                $lastEndTime = $currentDate->copy()->setHour(10)->setMinute(0); // First show at 10 AM
                
                for ($i = 0; $i < $showtimesCount; $i++) {
                    // Random movie for this showtime
                    $movie = $movies->random();
                    
                    // Calculate start and end times
                    $startTime = $lastEndTime->copy();
                    $endTime = $startTime->copy()->addMinutes($movie->duration + 30); // Add 30 minutes for cleaning/preparation
                    
                    // Create showtime
                    Showtime::create([
                        'movie_id' => $movie->id,
                        'screen_id' => $screen->id,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'ticket_price' => $this->calculateTicketPrice($screen, $movie),
                    ]);
                    
                    // Update last end time for next showtime
                    $lastEndTime = $endTime->copy()->addMinutes(30); // 30 minutes gap between shows
                }
            }
        }
        
        $this->command->info('Successfully created showtimes for the next 7 days.');
    }
    
    private function calculateTicketPrice(Screen $screen, Movie $movie): float
    {
        $basePrice = 500.00; // Base price in NPR
        
        // Adjust price based on screen type
        if (str_contains($screen->name, 'IMAX')) {
            $basePrice *= 1.5;
        } elseif (str_contains($screen->name, 'Premium')) {
            $basePrice *= 1.3;
        } elseif (str_contains($screen->name, 'VIP')) {
            $basePrice *= 2.0;
        }
        
        // Adjust price based on movie rating (higher rated movies cost more)
        $basePrice *= (1 + ($movie->rating / 10));
        
        return round($basePrice, 2);
    }
} 