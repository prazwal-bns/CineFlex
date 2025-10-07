<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowtimeResource\Pages;
use App\Filament\Resources\ShowtimeResource\Pages\Forms\ShowTimeResourceForm;
use App\Models\Showtime;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use UnitEnum;

class ShowtimeResource extends Resource
{
    protected static ?string $model = Showtime::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-clock';

    protected static string|UnitEnum|null $navigationGroup = 'Scheduling';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(ShowTimeResourceForm::getFields());
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
