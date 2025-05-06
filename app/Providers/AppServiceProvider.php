<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\EditProfileForm;
use App\Livewire\EditPasswordForm;
use App\Models\Screen;
use App\Observers\ScreenObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('edit-profile-form', EditProfileForm::class);
        Livewire::component('edit-password-form', EditPasswordForm::class);
        Screen::observe(ScreenObserver::class);
    }
}
