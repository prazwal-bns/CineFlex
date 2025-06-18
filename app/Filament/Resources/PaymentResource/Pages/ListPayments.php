<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Filament\Resources\PaymentResource\Pages\Tables\PaymentResourceTable;
use App\Models\Payment;
use Filament\Actions;
use Filament\Tables;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns(PaymentResourceTable::getFields())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
