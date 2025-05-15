<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeatResource\Pages;
use App\Filament\Resources\SeatResource\Pages\Forms\SeatResourceForm;
use App\Models\Seat;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class SeatResource extends Resource
{
    protected static ?string $model = Seat::class;

    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    protected static ?string $navigationGroup = 'Venue Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(SeatResourceForm::getFields());
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
            'index' => Pages\ListSeats::route('/'),
            'create' => Pages\CreateSeat::route('/create'),
            'view' => Pages\ViewSeat::route('/{record}'),
            'edit' => Pages\EditSeat::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'gray';
    }
}
