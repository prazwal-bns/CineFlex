<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Forms\Form;


class Profile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile';

    public array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }


    public function form(Form $form): Form
    {
        return $form
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
            ])
            ->statePath('data');
            // ->model(auth()->user());
    }

    public function mount(): void
    {
        $this->form->fill(
            auth()->user()->attributesToArray()
        );
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('Update')
                ->color('primary')
                ->submit('Update'),
        ];
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
}
