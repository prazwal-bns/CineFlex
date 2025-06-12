<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\TheaterManagerScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
#[ScopedBy([TheaterManagerScope::class])]
class Seat extends Model
{
    protected $fillable = [
        'screen_id',
        'row',
        'number',
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_seats');
    }
}
