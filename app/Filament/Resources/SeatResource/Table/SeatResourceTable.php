<?php

namespace App\Filament\Resources\SeatResource\Table;

use App\Filament\Contracts\ResourceFieldContract;
use App\Filament\Tables\Columns\LinkColumn;
use Filament\Tables;

final class SeatResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            LinkColumn::make('screen.name')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),
            Tables\Columns\TextColumn::make('row')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('secondary'),
            Tables\Columns\TextColumn::make('number')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('info'),
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
