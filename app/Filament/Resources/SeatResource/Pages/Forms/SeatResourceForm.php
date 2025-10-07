<?php

namespace App\Filament\Resources\SeatResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SeatResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Seat Information')
                ->description('Enter the seat details')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('screen_id')
                                ->label('Screen')
                                ->relationship('screen', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->columnSpan(2),

                            TextInput::make('row')
                                ->required()
                                ->maxLength(10)
                                ->columnSpan(1)
                                ->label('Row')
                                ->placeholder('Enter row (e.g. A, B, C)'),

                            TextInput::make('number')
                                ->required()
                                ->maxLength(10)
                                ->columnSpan(1)
                                ->label('Seat Number')
                                ->placeholder('Enter seat number'),
                        ]),
                ]),
        ];
    }
}
