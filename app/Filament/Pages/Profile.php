<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;

class Profile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.profile';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
