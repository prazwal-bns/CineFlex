<?php

namespace App\Filament\Resources\SeatResource\Pages;

use App\Filament\Resources\SeatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\ResourceTrait;
class CreateSeat extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = SeatResource::class;
}
