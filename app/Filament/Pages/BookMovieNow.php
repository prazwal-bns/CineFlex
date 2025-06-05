<?php

namespace App\Filament\Pages;

use App\Models\Movie;
use Filament\Pages\Page;

class BookMovieNow extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.book-movie-now';

    protected static ?string $title = 'Book a Movie';

    public $movies;

    public function mount(): void
    {
        $this->movies = Movie::get();
    }
}
