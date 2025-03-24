<?php

namespace App\Filament\Resources\UserResource\Pages\Forms;


use Filament\Forms;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;

final class UserResourceForm implements ResourceFieldContract
{
     public static function getFields(): array
     {
        return [
            Split::make([
                Section::make('Personal Information')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->avatar()
                            ->directory('avatars')
                            ->maxSize(2048)
                            ->live()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Address'),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number'),
                    ])
                    ->collapsible(),
            ])->from('md'),


            Split::make([
            Section::make('Account Information')
                ->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->visibleOn('create')
                        ->label('Password')
                        ->required(),
                    Forms\Components\Select::make('organization')
                        ->label('Organization Role')
                        ->options([
                            'superadmin' => 'Super Admin',
                            'theater_manager' => 'Theater Manager',
                            'customer' => 'Customer',
                        ])
                        ->selectablePlaceholder(false)
                        ->required(),
                ])
                ->collapsible(),
            ])->from('md'),
        ];
    }
}
