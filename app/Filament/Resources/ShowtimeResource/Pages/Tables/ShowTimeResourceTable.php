<?php

namespace App\Filament\Resources\ShowtimeResource\Pages\Tables;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Tables\Columns\TextColumn;

final class ShowTimeResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            TextColumn::make('movie.title')
                ->label('Movie Title')
                ->searchable()
                ->sortable()
                ->limit(25)
                ->tooltip(fn ($record) => $record->movie->title),

            TextColumn::make('screen.name')
                ->label('Screen')
                ->searchable()
                ->sortable(),

            TextColumn::make('start_time')
                ->label('Start Time')
                ->dateTime('F j, Y h:i A')
                ->sortable()
                ->badge()
                ->color('info'),

            TextColumn::make('end_time')
                ->label('End Time')
                ->dateTime('F j, Y h:i A')
                ->sortable()
                ->badge()
                ->color('danger'),

            TextColumn::make('ticket_price')
                ->label('Ticket Price (NPR)')
                ->money('NPR', true)
                ->sortable()
                ->color('success'),

            TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('d M, Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->color('gray'),

            TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime('d M, Y h:i A')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->color('gray'),
        ];
    }
}
