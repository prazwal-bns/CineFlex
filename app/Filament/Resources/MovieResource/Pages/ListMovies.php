<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Filament\Resources\MovieResource\Tables\MovieResourceTable;
use App\Models\Movie;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns(MovieResourceTable::getFields())
            ->filters([
                SelectFilter::make('title')
                    ->label('Title')
                    ->options(Movie::query()->pluck('title', 'id')->toArray())
                    ->searchable(),

                SelectFilter::make('duration')
                    ->label('Duration')
                    ->options([
                        'short' => 'Short (< 90 mins)',
                        'medium' => 'Medium (90-150 mins)',
                        'long' => 'Long (> 150 mins)',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value']) {
                            'short' => $query->where('duration', '<', 90),
                            'medium' => $query->whereBetween('duration', [90, 150]),
                            'long' => $query->where('duration', '>', 150),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->color('success'),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistFiltersInSession();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Add Movie'),
        ];
    }
}
