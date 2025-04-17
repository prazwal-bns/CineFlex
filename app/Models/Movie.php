<?php

namespace App\Models;

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
        'poster_file',
        'director',
        'genre',
        'rating',
        'language',
        'country',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function setPosterUrlAttribute($value)
    {
        if (request()->hasFile('poster_file')) {
            $this->attributes['poster_url'] = request()->file('poster_file')->store('posters', 'public');
        } else {
            $this->attributes['poster_url'] = $value;
        }
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
