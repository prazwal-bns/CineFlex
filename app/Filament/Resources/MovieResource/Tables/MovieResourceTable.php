<?php

namespace App\Filament\Resources\MovieResource\Tables;

use App\Filament\Contracts\ResourceFieldContract;
use App\Support\Helper;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
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

            TextColumn::make('genre')
                ->label('Genre')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('secondary')
                ->formatStateUsing(fn ($state) => Helper::capitalizeString($state))
                ->alignCenter(),

            TextColumn::make('release_date')
                ->label('Release Date')
                ->date('d M Y')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('duration')
                ->label('Duration')
                ->numeric()
                ->sortable()
                ->badge()
                ->color('success')
                ->formatStateUsing(fn ($state) => Str::title("{$state} min"))
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),

            TextColumn::make('director')
                ->label('Director')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),

            TextColumn::make('language')
                ->label('Language')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),

            TextColumn::make('country')
                ->label('Country')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->alignCenter(),

            TextColumn::make('rating')
                ->label('Rating')
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'G' => 'success',
                    'PG' => 'info',
                    'PG-13' => 'warning',
                    'R' => 'danger',
                    'NC-17' => 'gray',
                    default => 'secondary',
                })
                ->formatStateUsing(fn ($state) => Str::upper($state))
                ->toggleable(isToggledHiddenByDefault: true)
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
