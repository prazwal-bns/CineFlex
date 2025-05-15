<?php

namespace App\Filament\Resources\SeatResource\Pages;

use App\Filament\Resources\SeatResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateSeat extends CreateRecord
{
    use ResourceTrait;

    protected static string $resource = SeatResource::class;
}
