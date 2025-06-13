<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Movies', Movie::count())
                ->description('Total movies in the system')
                ->descriptionIcon('heroicon-m-film')
                ->color('success'),

            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Bookings', Booking::count())
                ->description('Movie bookings')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning'),
        ];
    }
}
