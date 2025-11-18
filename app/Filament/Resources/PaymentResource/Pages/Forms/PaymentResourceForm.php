<?php

namespace App\Filament\Resources\PaymentResource\Pages\Forms;

use App\Enums\PaymentStatus;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

final class PaymentResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Payment Details')
                ->description('Provide booking and payment information')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('booking_id')
                                ->label('Booking ID')
                                ->required()
                                ->numeric(),

                            TextInput::make('amount')
                                ->label('Amount')
                                ->required()
                                ->prefix('₹')
                                ->numeric(),
                        ]),
                ])
                ->columns(1)
                ->collapsible()
                ->collapsed(false),

            Section::make('Payment Method & Status')
                ->description('Choose how the payment was made and update its status')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('payment_method')
                                ->label('Payment Method')
                                ->options([
                                    'cash' => 'Cash',
                                    'online' => 'Online',
                                ])
                                ->required(),

                            Select::make('status')
                                ->label('Payment Status')
                                ->options(PaymentStatus::labels())
                                ->required(),
                        ]),

                    TextInput::make('transaction_id')
                        ->label('Transaction ID')
                        ->placeholder('Leave blank if payment was in cash'),
                ])
                ->columns(1)
                ->collapsible()
                ->collapsed(false),
        ];
    }
}
