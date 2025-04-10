<?php

namespace App\Filament\Resources\SeatResource\Pages;

use App\Filament\Resources\SeatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeat extends EditRecord
{
    protected static string $resource = SeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
