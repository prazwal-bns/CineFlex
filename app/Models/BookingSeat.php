<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    protected $table = 'booking_seats';

    protected $fillable = [
        'booking_id',
        'seat_id',
    ];
}
