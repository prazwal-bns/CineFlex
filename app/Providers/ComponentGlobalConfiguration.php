<?php

namespace App\Providers;

use Filament\Schemas\Components\Section;

class ComponentGlobalConfiguration
{
    /**
     * Configure global settings for Filament components
     */
    public static function configure(): void
    {
        self::configureSection();
        // Add more component configurations here as needed
    }

    /**
     * Configure Section components globally
     */
    private static function configureSection(): void
    {
        Section::configureUsing(function (Section $section) {
            $section->columnSpanFull();
        });
    }
}
