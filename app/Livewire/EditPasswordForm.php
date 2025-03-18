<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditPasswordForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Change Password')
                ->description('Ensure your account is using a secure password.')
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->required()
                        ->rule('current_password'),
                    TextInput::make('password')
                        ->label('New Password')
                        ->password()
                        ->required()
                        ->rule(Password::defaults())
                        ->confirmed(),
                    TextInput::make('password_confirmation')
                        ->label('Confirm New Password')
                        ->password()
                        ->required(),
                ]),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function updatePassword(): void
    {
        $state = $this->form->getState();

        auth()->user()->update([
            'password' => Hash::make($state['password']),
        ]);

        Auth::logout();

        Notification::make()
            ->title('Password updated!')
            ->success()
            ->send();

        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.edit-password-form');
    }
}
