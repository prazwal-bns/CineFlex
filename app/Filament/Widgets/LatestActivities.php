<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestActivities extends BaseWidget
{
    protected static ?string $heading = 'Latest Activities';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(
                Booking::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('showtime.movie.title')
                    ->label('Movie')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Booked At')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean()
                    ->label('Confirmed'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
