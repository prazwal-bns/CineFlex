<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateTheater extends CreateRecord
{
    use ResourceTrait;

    protected static string $resource = TheaterResource::class;
}
