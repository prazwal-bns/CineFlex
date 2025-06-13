<?php

namespace App\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Support\Contracts\TranslatableContentDriver;
use Filament\Widgets\Widget;

class QuickActions extends Widget implements HasActions
{
    use InteractsWithActions;

    protected static string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        return null;
    }

    protected function getActions(): array
    {
        return [
            Action::make('addMovie')
                ->label('Add New Movie')
                ->icon('heroicon-m-film')
                ->url(route('filament.admin.resources.movies.create'))
                ->color('success'),

            Action::make('bookNewMovie')
                ->label('Book a Movie')
                ->icon('heroicon-m-users')
                ->url(route('filament.admin.pages.book-movie-now'))
                ->color('info'),

            Action::make('viewBookings')
                ->label('View Bookings')
                ->icon('heroicon-m-ticket')
                ->url(route('filament.admin.resources.bookings.index'))
                ->color('primary'),

            Action::make('manageUsers')
                ->label('Manage Users')
                ->icon('heroicon-m-users')
                ->url(route('filament.admin.resources.users.index'))
                ->color('warning'),
        ];
    }
}
