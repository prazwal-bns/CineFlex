<?php

namespace App\Filament\Resources\ScreenResource\Pages;

use App\Filament\Resources\ScreenResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateScreen extends CreateRecord
{
    use ResourceTrait;

    protected static string $resource = ScreenResource::class;
}
