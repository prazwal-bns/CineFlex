<?php

namespace App\Filament\Resources\ScreenResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use App\Models\Theater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class ScreenResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Screen Information')
                ->description('Enter the basic information about the screen')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1)
                                ->label('Screen Name')
                                ->placeholder('Enter screen name'),

                            TextInput::make('capacity')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(100)
                                ->columnSpan(1)
                                ->label('Seating Capacity')
                                ->placeholder('Enter number of seats (max 100)')
                                ->helperText('Maximum capacity is 100 seats'),
                        ]),

                    Select::make('theater_id')
                        ->label('Theater')
                        ->relationship('theater', 'name')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                ]),
        ];
    }
}
