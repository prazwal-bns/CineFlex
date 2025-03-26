<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Spatie\Permission\Models\Role;

class UserImporter extends Importer
{

    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),

            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email', 'max:255']),

            ImportColumn::make('password')
                ->requiredMapping()
                ->rules(['required', 'string', 'min:8']),

            ImportColumn::make('organization')
                ->requiredMapping()
                ->rules(['required']),

            ImportColumn::make('address')
                ->rules(['nullable', 'string']),

            ImportColumn::make('phone')
                ->rules(['nullable', 'string']),
        ];
    }

    public function resolveRecord(): ?User
    {
        $user = User::where('email', $this->data['email'])->first();

        if (!$user) {
            $user = new User();
        }

        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        if ($customerRole && !$user->hasRole('customer')) {
            $user->assignRole($customerRole);
        }

        return $user;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your user import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
