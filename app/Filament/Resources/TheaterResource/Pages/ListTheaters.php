<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use App\Filament\Resources\TheaterResource\Table\TheaterResourceTable;
use App\Models\Theater;
use App\Support\Helper;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ListTheaters extends ListRecords
{
    protected static string $resource = TheaterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns(TheaterResourceTable::getFields())
            ->filters([
                SelectFilter::make('city')
                    ->label('City')
                    ->options(fn () => Theater::distinct()->pluck('city', 'city')->toArray())
                    ->searchable()
                    ->preload(),

                SelectFilter::make('manager')
                    ->label('Theater Manager')
                    ->relationship(
                        'manager',
                        'name',
                        fn ($query) => Helper::applyTheaterManagerFilter($query)
                    )
                    ->searchable()
                    ->preload(),

            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
