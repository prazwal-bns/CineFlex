<?php

namespace App\Filament\Contracts;

interface ResourceFieldContract
{
    /**
     * @return array<mixed>
     */
    public static function getFields(): array;
}
