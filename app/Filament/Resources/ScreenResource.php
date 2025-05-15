<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScreenResource\Pages;
use App\Filament\Resources\ScreenResource\Pages\Forms\ScreenResourceForm;
use App\Models\Screen;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class ScreenResource extends Resource
{
    protected static ?string $model = Screen::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Venue Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ScreenResourceForm::getFields());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScreens::route('/'),
            'create' => Pages\CreateScreen::route('/create'),
            'view' => Pages\ViewScreen::route('/{record}'),
            'edit' => Pages\EditScreen::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }
}
