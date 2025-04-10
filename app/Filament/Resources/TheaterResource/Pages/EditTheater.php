<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTheater extends EditRecord
{
    protected static string $resource = TheaterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
