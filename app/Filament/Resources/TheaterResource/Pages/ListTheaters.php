<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTheaters extends ListRecords
{
    protected static string $resource = TheaterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
