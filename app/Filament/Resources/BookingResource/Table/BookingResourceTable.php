<?php

namespace App\Filament\Resources\BookingResource\Table;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Support\Enums\TextSize;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

final class BookingResourceTable implements ResourceFieldContract
{
    /**
     * Get the form fields for the address resource.
     *
     * @return array<int, mixed>
     */
    public static function getFields(): array
    {
        return [
            ImageColumn::make('showtime.movie.poster_url')
                ->label('Poster')
                ->square()
                ->size(120)
                ->extraImgAttributes(['class' => 'rounded-lg shadow-md'])
                ->alignLeft(),

            TextColumn::make('showtime.movie.title')
                ->label('Movie Title')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->size(TextSize::Large)
                ->wrap(),

            TextColumn::make('showtime.start_time')
                ->label('Showtime')
                ->dateTime('F j, Y h:i A')
                ->sortable()
                ->badge()
                ->color('info')
                ->icon('heroicon-o-clock')
                ->alignCenter(),

            TextColumn::make('showtime.movie.duration')
                ->label('Duration')
                ->formatStateUsing(fn ($state) => $state.' mins')
                ->sortable()
                ->icon('heroicon-o-film')
                ->alignCenter(),

            TextColumn::make('user.name')
                ->label('Booked By')
                ->searchable()
                ->badge()
                ->color('info')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'confirmed' => 'success',
                    'pending' => 'warning',
                    'cancelled' => 'danger',
                })
                ->icon(fn (string $state): string => match ($state) {
                    'confirmed' => 'heroicon-o-check-circle',
                    'pending' => 'heroicon-o-clock',
                    'cancelled' => 'heroicon-o-x-circle',
                })
                ->searchable()
                ->alignCenter(),

            TextColumn::make('total_price')
                ->label('Price')
                ->money('NPR', true)
                ->sortable()
                ->color('success')
                ->icon('heroicon-o-currency-dollar')
                ->alignCenter(),

            TextColumn::make('created_at')
                ->label('Booked On')
                ->dateTime('d M, Y h:i A')
                ->sortable()
                ->icon('heroicon-o-calendar')
                ->alignCenter()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * Get the table actions for the resource.
     *
     * @return array<int, mixed>
     */
    public static function getActions(): array
    {
        return [
            Action::make('book')
                ->label('Book Now')
                ->icon('heroicon-o-ticket')
                ->color('success')
                ->url(fn ($record) => route('bookings.create', ['showtime' => $record->showtime_id]))
                ->visible(fn ($record) => $record->status === 'pending')
                ->button()
                ->size('sm'),
        ];
    }
}
