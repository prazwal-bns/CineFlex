<?php

namespace App\Filament\Resources\PaymentResource\Pages\Tables;

use App\Filament\Contracts\ResourceFieldContract;
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
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->searchable(),
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
