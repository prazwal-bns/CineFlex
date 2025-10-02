<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScreenResource\Pages;
use App\Filament\Resources\ScreenResource\Pages\Forms\ScreenResourceForm;
use App\Models\Screen;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class ScreenResource extends Resource
{
    protected static ?string $model = Screen::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-film';

    protected static string|UnitEnum|null $navigationGroup = 'Venue Management';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(ScreenResourceForm::getFields());
    }


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        if ($user && $user->isTheaterManager()) {
            $query->whereHas('theater', function ($q) use ($user) {
                $q->where('manager_id', $user->id);
            });
        }

        return $query;
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
