<?php

namespace App\Filament\Resources\UserResource\Pages\Forms;


use Filament\Forms;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;

final class UserResourceForm implements ResourceFieldContract
{
     public static function getFields(): array
     {
         return [
            Section::make('User Information')
                ->schema([
                    FileUpload::make('avatar')
                        ->image()
                        ->avatar()
                        ->directory('avatars')
                        ->maxSize(2048)
                        ->live()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->visibleOn('create')
                        ->required(),
                    Forms\Components\Select::make('organization')
                        ->options([
                            'superadmin' => 'Super Admin',
                            'theater_manager' => 'Theater Manager',
                            'customer' => 'Customer',
                        ])
                        ->selectablePlaceholder(false)
                        ->required(),
                ])
            ];
    }
}
