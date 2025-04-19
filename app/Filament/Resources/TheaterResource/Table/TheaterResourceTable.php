<?php

namespace App\Filament\Resources\TheaterResource\Table;

use App\Filament\Contracts\ResourceFieldContract;
use App\Filament\Tables\Columns\LinkColumn;
use Filament\Tables;

final class TheaterResourceTable implements ResourceFieldContract
{

    public static function getFields(): array
    {
        return [
            LinkColumn::make('name')
                ->url(fn($record) => route('filament.admin.resources.theaters.view', ['record' => $record->id]))
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),
            Tables\Columns\TextColumn::make('city')
                ->searchable()
                ->badge()
                ->color('secondary'),
            Tables\Columns\TextColumn::make('manager.name')
                ->sortable()
                ->searchable()
                ->badge()
                ->color('success'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
