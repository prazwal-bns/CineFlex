<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $fillable = [
        'theater_id',
        'name',
        'capacity',
    ];

    protected static function booted()
    {
        static::created(function ($screen) {
            $screen->generateSeats();
        });

        static::updated(function ($screen) {
            if ($screen->isDirty('capacity')) {
                // Delete existing seats
                $screen->seats()->delete();
                // Generate new seats
                $screen->generateSeats();
            }
        });
    }

    public function generateSeats()
    {
        $rows = range('A', 'J');
        $seatsPerRow = 10;
        $totalSeats = 0;

        foreach ($rows as $row) {
            for ($number = 1; $number <= $seatsPerRow; $number++) {
                if ($totalSeats >= $this->capacity) {
                    break 2;
                }

                $this->seats()->create([
                    'row' => $row,
                    'number' => $number,
                ]);

                $totalSeats++;
            }
        }
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
