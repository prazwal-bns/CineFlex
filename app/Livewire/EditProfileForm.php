<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Profile Information')
                    ->description('Update your account\'s profile information.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('avatars')
                            ->maxSize(5048)
                            ->visibility('public')
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
                ->label('Update Profile')
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
