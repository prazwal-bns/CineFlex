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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove fields that shouldn't be saved directly
        unset($data['password_confirmation']);

        return $data;
    }

    protected function afterCreate(): void
    {
        // Get roles from form state (since field is dehydrated=false, it's not in $data)
        $formData = $this->form->getState();
        if (isset($formData['roles']) && !empty($formData['roles'])) {
            $roles = is_array($formData['roles']) ? $formData['roles'] : [$formData['roles']];
            $this->record->syncRoles($roles);
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
