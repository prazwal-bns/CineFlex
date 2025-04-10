<?php

namespace App\Filament\Resources\BookingSeatResource\Pages;

use App\Filament\Resources\BookingSeatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingSeat extends EditRecord
{
    protected static string $resource = BookingSeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
