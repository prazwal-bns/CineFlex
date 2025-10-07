<?php

namespace App\Filament\Resources\UserResource\Pages\Forms;

use App\Enums\OrganizationType;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Split;
use Spatie\Permission\Contracts\Role;

final class UserResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
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
                    ->columnSpan(1)
                    ->collapsible(),

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
                    ->columnSpan(1)
                    ->collapsible(),
        ];
    }
}
