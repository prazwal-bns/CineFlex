<?php

namespace App\Filament\Resources\BookingSeatResource\Pages;

use App\Filament\Resources\BookingSeatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookingSeats extends ListRecords
{
    protected static string $resource = BookingSeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
