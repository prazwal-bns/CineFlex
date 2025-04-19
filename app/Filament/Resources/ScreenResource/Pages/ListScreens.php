<?php

namespace App\Filament\Resources\ScreenResource\Pages;

use App\Filament\Resources\ScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ScreenResource\Table\ScreenResourceTable;
use Filament\Tables\Table;


class ListScreens extends ListRecords
{
    protected static string $resource = ScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public  function table(Table $table): Table
    {
        return $table
            ->columns(ScreenResourceTable::getFields());
    }
}
