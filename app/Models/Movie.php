<?php

namespace App\Models;

use App\Enums\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'poster_url',
        'director',
        'genre',
        'rating',
        'language',
        'country',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
        'genre' => 'array',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function getPosterUrlAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        if (Str::startsWith($value, 'http')) {
            return $value;
        }

        return Storage::disk('public')->url($value);
    }
}
