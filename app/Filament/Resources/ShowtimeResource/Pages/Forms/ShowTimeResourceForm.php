<?php

namespace App\Filament\Resources\ShowtimeResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

final class ShowTimeResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make()
                ->schema([
                    Forms\Components\Select::make('movie_id')
                        ->relationship('movie', 'title')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->label('Select Movie'),

                    Forms\Components\Select::make('screen_id')
                        ->relationship('screen', 'name')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->label('Select Screen'),

                    Grid::make(2)
                        ->schema([
                            Forms\Components\DateTimePicker::make('start_time')
                                ->required()
                                ->native(false)
                                ->label('Start Time')
                                ->minutesStep(5),

                            Forms\Components\DateTimePicker::make('end_time')
                                ->required()
                                ->native(false)
                                ->label('End Time')
                                ->minutesStep(5),
                        ]),

                    Forms\Components\TextInput::make('ticket_price')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->minValue(0)
                        ->step(0.01)
                        ->label('Ticket Price'),
                ])
                ->columns(1),
        ];
    }
}
