<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Support\Collection;

class BookMovieNow extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationLabel = 'Book Movies';
    protected static string $view = 'filament.pages.book-movie-now';

    public Collection $movies;

    public function mount(): void
    {
        $this->loadMovies();
    }

    public function loadMovies(): void
    {
        $this->movies = Movie::with(['showtimes' => function ($query) {
            $query->where('start_time', '>', now())
                  ->orderBy('start_time', 'asc');
        }])
        ->whereHas('showtimes', function ($query) {
            $query->where('start_time', '>', now());
        })
        ->get();
    }

    public function selectShowtime($movieId, $showtimeId)
    {
        return redirect()->route('filament.admin.pages.select-showtime', [
            'movie' => $movieId,
            'showtime' => $showtimeId
        ]);
    }
}
