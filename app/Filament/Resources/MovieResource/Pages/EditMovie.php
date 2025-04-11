<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMovie extends EditRecord
{
    use ResourceTrait;
    protected static string $resource = MovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
