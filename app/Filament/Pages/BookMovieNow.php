<?php

namespace App\Filament\Pages;

use App\Models\Movie;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class BookMovieNow extends Page
{
    use WithPagination;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.book-movie-now';

    protected static ?string $title = 'Book a Movie';

    #[Url]
    public $search = '';

    #[Url]
    public $genre = '';

    public function mount(): void
    {
        // No need to call loadMovies here as it will be handled by the view
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedGenre(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->genre = '';
        $this->resetPage();
    }

    public function getMoviesProperty()
    {
        $query = Movie::query();

        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }

        if ($this->genre) {
            $query->where('genre', 'like', '%'.$this->genre.'%');
        }

        return $query->paginate(5);
    }

    public function selectShowtime($showtimeId)
    {
        return redirect()->route('filament.admin.pages.select-seats', ['showtimeId' => $showtimeId]);
    }
}
