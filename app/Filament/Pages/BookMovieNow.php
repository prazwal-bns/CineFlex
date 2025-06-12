<?php

namespace App\Filament\Pages;

use App\Models\Movie;
use Filament\Pages\Page;
use Livewire\Attributes\Url;

class BookMovieNow extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.book-movie-now';

    protected static ?string $title = 'Book a Movie';

    public $movies;

    #[Url]
    public $search = '';

    #[Url]
    public $genre = '';

    public function mount(): void
    {
        $this->loadMovies();
    }

    public function updatedSearch(): void
    {
        $this->loadMovies();
    }

    public function updatedGenre(): void
    {
        $this->loadMovies();
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->genre = '';
        $this->loadMovies();
    }

    protected function loadMovies(): void
    {
        $query = Movie::query();

        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }

        if ($this->genre) {
            $query->where('genre', 'like', '%'.$this->genre.'%');
        }

        $this->movies = $query->get();
    }
}
