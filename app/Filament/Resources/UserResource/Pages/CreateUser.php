<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected ?array $rolesToSync = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store roles before removing from data
        if (isset($data['roles'])) {
            $this->rolesToSync = is_array($data['roles']) ? $data['roles'] : [$data['roles']];
        }

        // Remove fields that shouldn't be saved directly
        unset($data['roles'], $data['password_confirmation']);

        return $data;
    }

    protected function afterCreate(): void
    {
        // Sync roles after user is created
        if (!empty($this->rolesToSync)) {
            $this->record->syncRoles($this->rolesToSync);
        }

        // $admin = User::where('email', 'admin@gmail.com')->first();
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->first();

        if ($admin) {
            Notification::make()
                ->title('New User Created !')
                ->icon('heroicon-o-calendar')
                ->body('A new user has been successfully created!')
                ->success()
                ->sendToDatabase($admin);

            event(new DatabaseNotificationsSent($admin));
        }
    }
}
