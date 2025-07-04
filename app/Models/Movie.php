<?php

namespace App\Models;

use App\Enums\MovieGenres;
use App\Traits\SortsByLatest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Movie extends Model
{
    use SoftDeletes, SortsByLatest;

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

    public function getGenreAttribute($value): array
    {
        return collect(json_decode($value, true))
            ->map(fn($genre) => MovieGenres::from($genre))
            ->toArray();
    }

    public function setGenreAttribute(array $value): void
    {
        $this->attributes['genre'] = json_encode(
            collect($value)->map(fn($genre) =>
                $genre instanceof MovieGenres ? $genre->value : $genre
            )
        );
    }

}
