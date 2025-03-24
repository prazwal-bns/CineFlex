<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function handleRecordCreation(array $data): Model{
        $record = parent::handleRecordCreation($data);

        // $admin = User::where('email', 'admin@gmail.com')->first();
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->first();

        if ($admin) {
            Notification::make()
                ->title('New User Created !')
                ->icon('heroicon-o-calendar')
                ->body("A new user has been successfully created!")
                ->success()
                ->sendToDatabase($admin);

            event(new DatabaseNotificationsSent($admin));
        }

        return $record;
    }
}
