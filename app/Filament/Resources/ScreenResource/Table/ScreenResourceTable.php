<?php

namespace App\Filament\Resources\ScreenResource\Table;

use App\Filament\Contracts\ResourceFieldContract;
use App\Filament\Tables\Columns\LinkColumn;
use Filament\Tables;

final class ScreenResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            LinkColumn::make('name')
                ->url(fn ($record) => route('filament.admin.resources.screens.view', ['record' => $record->id]))
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),

            Tables\Columns\TextColumn::make('theater.name')
                ->label('Theater')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('secondary'),

            Tables\Columns\TextColumn::make('capacity')
                ->numeric()
                ->sortable()
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
