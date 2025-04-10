<?php

namespace App\Filament\Resources\ScreenResource\Pages;

use App\Filament\Resources\ScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewScreen extends ViewRecord
{
    protected static string $resource = ScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
