<?php

namespace App\Filament\Resources\UserResource\Table;

use App\Filament\Contracts\ResourceFieldContract;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Tables\Columns\LinkColumn;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

final class UserResourceTable implements ResourceFieldContract
{
    /**
     * Get the form fields for the address resource.
     *
     * @return array<int, mixed>
     */
    public static function getFields(): array
    {
        return [
            Tables\Columns\ImageColumn::make('avatar')
                ->circular()
                ->label('User Image')
                ->sortable()
                // ->url(fn ($record) => asset('storage/' . $record->avatar))
                ->url(fn ($record) => $record->avatar
                    ? asset('storage/' . $record->avatar)
                    : asset('storage/avatar.jpg'))
                ->default(asset('storage/avatar.jpg'))
                ->size(70)
                ->openUrlInNewTab(true),
            LinkColumn::make('name')
                ->url(fn ($record) => route('filament.admin.resources.users.edit', ['record' => $record->id]))
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('roles.name')
                ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                ->sortable()
                ->badge()
                ->color('secondary')
                ->searchable(),
            Tables\Columns\TextColumn::make('organization')
                ->searchable()
                ->badge()
                ->color('secondary'),
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
