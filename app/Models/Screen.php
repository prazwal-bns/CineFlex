<?php

namespace App\Models;

use App\Scopes\TheaterManagerScope;
use App\Traits\SortsByLatest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([TheaterManagerScope::class])]
class Screen extends Model
{
    use SortsByLatest;
    protected $fillable = [
        'theater_id',
        'name',
        'capacity',
    ];

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
