<?php

namespace App\Filament\Resources\PaymentResource\Pages\Forms;

use App\Enums\PaymentStatus;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;

final class PaymentResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Forms\Components\Section::make('Payment Details')
                ->description('Provide booking and payment information')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('booking_id')
                                ->label('Booking ID')
                                ->required()
                                ->numeric(),

                            Forms\Components\TextInput::make('amount')
                                ->label('Amount')
                                ->required()
                                ->prefix('₹')
                                ->numeric(),
                        ]),
                ])
                ->columns(1)
                ->collapsible()
                ->collapsed(false),

            Forms\Components\Section::make('Payment Method & Status')
                ->description('Choose how the payment was made and update its status')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('payment_method')
                                ->label('Payment Method')
                                ->options([
                                    'cash' => 'Cash',
                                    'online' => 'Online',
                                ])
                                ->required(),

                            Forms\Components\Select::make('status')
                                ->label('Payment Status')
                                ->options(PaymentStatus::labels())
                                ->required(),
                        ]),

                    Forms\Components\TextInput::make('transaction_id')
                        ->label('Transaction ID')
                        ->placeholder('Leave blank if payment was in cash'),
                ])
                ->columns(1)
                ->collapsible()
                ->collapsed(false),
        ];
    }
}
