<?php

namespace App\Filament\Resources\ScreenResource\Pages;

use App\Filament\Resources\ScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScreen extends EditRecord
{
    protected static string $resource = ScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
