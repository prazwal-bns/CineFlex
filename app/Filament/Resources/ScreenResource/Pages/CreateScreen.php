<?php

namespace App\Filament\Resources\ScreenResource\Pages;

use App\Filament\Resources\ScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\ResourceTrait;
class CreateScreen extends CreateRecord
{
    use ResourceTrait;
    protected static string $resource = ScreenResource::class;
}
