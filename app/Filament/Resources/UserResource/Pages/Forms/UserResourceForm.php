<?php

namespace App\Filament\Resources\UserResource\Forms;

use Filament\Forms;
use App\Filament\Contracts\ResourceFieldContract;

final class UserResourceForm implements ResourceFieldContract
{
    /**
     * Get the form fields for the address resource.
     *
     * @return array<int, mixed>
     */

     public static function getFields(): array
     {
         return [
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('avatar'),
                Forms\Components\TextInput::make('organization')
                    ->required(),
            ];
    }
}
