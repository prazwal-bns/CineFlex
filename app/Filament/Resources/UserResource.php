<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\Forms\UserResourceForm;
use App\Models\User;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use UnitEnum;


class UserResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-users';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(UserResourceForm::getFields());
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
}
