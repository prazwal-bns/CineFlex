<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovie extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = MovieResource::class;
}
