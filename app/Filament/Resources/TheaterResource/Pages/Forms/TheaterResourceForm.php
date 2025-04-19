<?php

namespace App\Filament\Resources\TheaterResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use App\Models\Theater;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Spatie\Permission\Models\Role;

class TheaterResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Theater Information')
                ->description('Enter the basic information about the theater')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1)
                                ->label('Theater Name')
                                ->placeholder('Enter theater name'),

                            TextInput::make('city')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1)
                                ->label('City')
                                ->placeholder('Enter city name'),
                        ]),

                    Textarea::make('address')
                        ->required()
                        ->maxLength(65535)
                        ->columnSpanFull()
                        ->label('Full Address')
                        ->placeholder('Enter complete theater address')
                        ->rows(3),
                ]),

            Section::make('Theater Management')
                ->description('Assign a manager to oversee the theater operations')
                ->schema([
                    Select::make('manager_id')
                        ->label('Theater Manager')
                        ->options(User::getTheaterManagers())
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(1)
                                        ->label('Manager Name')
                                        ->placeholder('Enter manager name'),

                                    TextInput::make('email')
                                        ->email()
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(1)
                                        ->label('Email Address')
                                        ->placeholder('Enter manager email'),
                                ]),
                        ])
                        ->nullable()
                        ->helperText('Select an existing theater manager or create a new one'),
                ]),
        ];
    }
}
