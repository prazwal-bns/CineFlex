<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use ResourceTrait;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Populate roles field with existing user roles
        if ($this->record && $this->record->roles) {
            $data['roles'] = $this->record->roles->pluck('id')->first(); // Get first role ID
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove fields that shouldn't be saved directly
        unset($data['password_confirmation']);

        return $data;
    }

    protected function afterSave(): void
    {
        // Get roles from form state (since field is dehydrated=false, it's not in $data)
        $formData = $this->form->getState();
        if (isset($formData['roles']) && !empty($formData['roles'])) {
            $roles = is_array($formData['roles']) ? $formData['roles'] : [$formData['roles']];
            $this->record->syncRoles($roles);
        }
    }
}
