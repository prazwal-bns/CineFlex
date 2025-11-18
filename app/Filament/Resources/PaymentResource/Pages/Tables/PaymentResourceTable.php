<?php

namespace App\Filament\Resources\PaymentResource\Pages\Tables;

use App\Enums\PaymentStatus;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Notifications\Notification;
use Filament\Tables;

final class PaymentResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Tables\Columns\TextColumn::make('booking_id')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('amount')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('payment_method')
                ->badge()
                ->color('secondary')
                ->searchable(),
            Tables\Columns\TextColumn::make('transaction_id')
                ->searchable(),
            Tables\Columns\SelectColumn::make('status')
                ->options(PaymentStatus::labels())
                ->searchable()
                ->selectablePlaceholder(false)
                ->width('100px')
                ->afterStateUpdated(function ($state, $record) {
                    $record->status = PaymentStatus::from($state);
                    $record->save();

                    Notification::make()
                        ->title('Payment Status Updated')
                        ->body('The payment status has been updated to ' . $record->status->getLabels())
                        ->success()
                        ->send();
                }),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
