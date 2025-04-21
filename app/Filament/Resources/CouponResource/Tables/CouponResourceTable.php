<?php

namespace App\Filament\Resources\CouponResource\Tables;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Tables;

final class CouponResourceTable implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Tables\Columns\TextColumn::make('code')
                ->searchable()
                ->sortable()
                ->label('Coupon Code')
                ->badge()
                ->color('accent')
                ->formatStateUsing(fn($state) => strtoupper($state)),

            Tables\Columns\TextColumn::make('description')
                ->searchable()
                ->sortable()
                ->label('Description')
                ->limit(50)
                ->wrap()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('discount_type')
                ->searchable()
                ->sortable()
                ->label('Discount Type')
                ->formatStateUsing(fn($state) => ucfirst($state))
                ->badge()
                ->color(fn($state) => $state === 'percentage' ? 'success' : 'primary'),

            Tables\Columns\TextColumn::make('discount_value')
                ->numeric()
                ->sortable()
                ->label('Discount Value')
                ->formatStateUsing(fn($state, $record) => $record->discount_type === 'percentage' ? "{$state} %" : "\$ {$state}")
                ->badge()
                ->color(fn($state, $record) => $record->discount_type === 'percentage' ? 'success' : 'primary'),

            Tables\Columns\TextColumn::make('valid_until')
                ->date('M d, Y')
                ->sortable()
                ->label('Expires At')
                ->badge()
                ->color('danger'),

            Tables\Columns\TextColumn::make('usage_limit')
                ->numeric()
                ->sortable()
                ->label('Usage')
                ->formatStateUsing(fn($state, $record) => "{$record->times_used}/" . ($state ?? '∞'))
                ->badge()
                ->color(
                    fn($state, $record) =>
                    $record->usage_limit && $record->times_used >= $record->usage_limit ? 'danger' : 'success'
                ),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->label('Status')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger'),

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
