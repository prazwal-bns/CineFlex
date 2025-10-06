<?php

namespace App\Filament\Resources\UserResource\Pages\Forms;

use App\Enums\OrganizationType;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Spatie\Permission\Contracts\Role;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\Layout\Split;

final class UserResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Split::make([
                Section::make('Personal Information')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->avatar()
                            ->directory('avatars')
                            ->maxSize(2048)
                            ->live()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Address'),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number'),
                    ])
                    ->collapsible(),
            ])->from('md'),

            Split::make([
                Section::make('Account Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->visibleOn('create')
                            ->label('Password')
                            ->required(),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->visibleOn('create')
                            ->label('Confirm Password')
                            ->required()
                            ->same('password')
                            ->validationMessages([
                                'same' => 'The passwords do not match.',
                            ]),
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->preload()
                            ->required()
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(function (?Role $record): string {
                                return $record?->name ? str($record->name)->headline() : '';
                            }),
                        Forms\Components\Select::make('organization')
                            ->label('Organization Role')
                            ->options(OrganizationType::labels())
                            ->selectablePlaceholder(false)
                            ->required(),
                    ])
                    ->collapsible(),
            ])->from('md'),
        ];
    }
}
