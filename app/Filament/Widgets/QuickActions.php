<?php

namespace App\Filament\Widgets;

use App\Support\Helper;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class QuickActions extends Widget implements HasActions
{
    use InteractsWithActions;

    protected string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getActions(): array
    {
        return [
            Action::make('addMovie')
                ->label('Add New Movie')
                ->icon('heroicon-m-film')
                ->url(route('filament.admin.resources.movies.create'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('create_movie'))
                ->color('success'),

            Action::make('bookNewMovie')
                ->label('Book a Movie')
                ->icon('heroicon-m-tv')
                ->url(route('filament.admin.pages.book-movie-now'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('book_movie') || Auth::user()->isCustomer())
                ->color('info'),

            Action::make('viewBookings')
                ->label('View Bookings')
                ->icon('heroicon-m-ticket')
                ->url(route('filament.admin.resources.bookings.index'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('view_bookings'))
                ->color('primary'),

            Action::make('manageUsers')
                ->label('Manage Users')
                ->icon('heroicon-m-users')
                ->url(route('filament.admin.resources.users.index'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('view_users'))
                ->color('accent'),

            Action::make('managePayments')
                ->label('Manage Payments')
                ->icon('heroicon-m-currency-dollar')
                ->url(route('filament.admin.resources.payments.index'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('view_payments'))
                ->color('pink'),

            Action::make('manageCoupons')
                ->label('Manage Coupons')
                ->icon('heroicon-m-credit-card')
                ->url(route('filament.admin.resources.coupons.index'))
                ->extraAttributes(Helper::getButtonStyles())
                ->visible(fn() => Auth::user()->can('view_coupons'))
                ->color('rose'),
        ];
    }
}
