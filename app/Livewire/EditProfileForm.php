<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Livewire\WithFileUploads;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class EditProfileForm extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            auth()->user()->attributesToArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Information')
                    ->description('Update your account\'s profile information.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->avatar()
                            ->directory('avatars')
                            ->maxSize(5048)
                            ->live()
                            ->columnSpanFull(),
                        TextInput::make('email')
                            ->disabled(),
                        TextInput::make('name')
                            ->autofocus()
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function getSaveAction(): Action
    {
        return
            Action::make('save')
                ->label('Update Profile}')
                ->submit('save');
    }

    public function update(): void
    {
        auth()->user()->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Profile updated!')
            ->success()
            ->send();

        $this->redirect('/admin');
    }

    public function render()
    {
        return view('livewire.edit-profile-form');
    }
}
