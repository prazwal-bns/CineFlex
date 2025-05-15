<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TheaterResource\Pages;
use App\Filament\Resources\TheaterResource\Pages\Forms\TheaterResourceForm;
use App\Models\Theater;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class TheaterResource extends Resource
{
    protected static ?string $model = Theater::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-storefront';

    protected static ?string $navigationGroup = 'Venue Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TheaterResourceForm::getFields());
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
            'index' => Pages\ListTheaters::route('/'),
            'create' => Pages\CreateTheater::route('/create'),
            'view' => Pages\ViewTheater::route('/{record}'),
            'edit' => Pages\EditTheater::route('/{record}/edit'),
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
