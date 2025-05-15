<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowtimeResource\Pages;
use App\Filament\Resources\ShowtimeResource\Pages\Forms\ShowTimeResourceForm;
use App\Models\Showtime;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class ShowtimeResource extends Resource
{
    protected static ?string $model = Showtime::class;

    protected static ?string $navigationIcon = 'heroicon-s-clock';

    protected static ?string $navigationGroup = 'Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ShowTimeResourceForm::getFields());
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
            'index' => Pages\ListShowtimes::route('/'),
            'create' => Pages\CreateShowtime::route('/create'),
            'view' => Pages\ViewShowtime::route('/{record}'),
            'edit' => Pages\EditShowtime::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
