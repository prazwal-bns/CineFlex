<?php

namespace App\Filament\Resources\SeatResource\Pages;

use App\Filament\Resources\SeatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSeat extends ViewRecord
{
    protected static string $resource = SeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
