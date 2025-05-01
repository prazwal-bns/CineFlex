<?php

namespace App\Filament\Resources\TheaterResource\Pages;

use App\Filament\Resources\TheaterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\ResourceTrait;
class CreateTheater extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = TheaterResource::class;
}
