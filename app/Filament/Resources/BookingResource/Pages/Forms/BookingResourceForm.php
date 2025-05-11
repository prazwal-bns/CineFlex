<?php

namespace App\Filament\Resources\BookingResource\Pages\Forms;
use Filament\Forms;


use App\Filament\Contracts\ResourceFieldContract;

final class BookingResourceForm implements ResourceFieldContract{
    public static function getFields(): array
    {
        return [
            Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('showtime_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coupon_id')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('discounted_price')
                    ->required()
                    ->numeric(),
        ];
    }
}
