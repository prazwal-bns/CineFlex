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

    protected ?array $rolesToSync = null;

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
        // Store roles before removing from data
        if (isset($data['roles'])) {
            $this->rolesToSync = is_array($data['roles']) ? $data['roles'] : [$data['roles']];
        }

        // Remove fields that shouldn't be saved directly
        unset($data['roles'], $data['password_confirmation']);

        return $data;
    }

    protected function afterSave(): void
    {
        // Sync roles after user is updated
        if (!empty($this->rolesToSync)) {
            $this->record->syncRoles($this->rolesToSync);
        }
    }
}
