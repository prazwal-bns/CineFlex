<?php

namespace App\Filament\Resources\PaymentResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;

final class PaymentResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Forms\Components\TextInput::make('booking_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('payment_method')
                    ->required(),
                Forms\Components\TextInput::make('transaction_id'),
                Forms\Components\TextInput::make('status')
                    ->required(),
        ];
    }
}
