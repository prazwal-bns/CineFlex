<?php

namespace App\Providers;

use App\Livewire\EditPasswordForm;
use App\Livewire\EditProfileForm;
use App\Models\Screen;
use App\Observers\ScreenObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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

        // Configure global component settings
        ComponentGlobalConfiguration::configure();
    }
}
