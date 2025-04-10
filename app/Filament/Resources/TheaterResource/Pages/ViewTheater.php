<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTheater extends ViewRecord
{
    protected static string $resource = TheaterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
