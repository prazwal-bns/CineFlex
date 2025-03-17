<?php

namespace App\Filament\Traits;

trait ResourceTrait
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
