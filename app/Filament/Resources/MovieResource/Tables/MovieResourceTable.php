<?php

namespace App\Filament\Resources\MovieResource\Tables;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Support\Str;

final class MovieResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            ImageColumn::make('poster_url')
                ->label('Poster')
                ->square()
                ->size(120)
                ->extraImgAttributes(['class' => 'rounded-lg shadow-md'])
                ->alignLeft(),

            TextColumn::make('title')
                ->label('Movie Title')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->size(TextColumn\TextColumnSize::Large)
                ->wrap(),

            TextColumn::make('duration')
                ->label('Duration')
                ->numeric()
                ->sortable()
                ->formatStateUsing(fn ($state) => "{$state} minutes")
                ->alignCenter(),

            TextColumn::make('release_date')
                ->label('Release Date')
                ->date('d M Y')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('created_at')
                ->label('Added')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),

            TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),
        ];
    }
}
