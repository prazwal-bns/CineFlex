<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Profile;
use App\Filament\Widgets\CustomAccountWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->spa()
            ->userMenuItems([
                Action::make('profile')
                    ->label('Profile')
                    ->url(fn (): string => Profile::getUrl())
                    ->icon('heroicon-o-user'),
            ])
            ->colors([
                'primary' => Color::Amber,
                'secondary' => '#106681',
                'success' => Color::Emerald,
                'danger' => Color::Rose,
                'warning' => Color::Amber,
                'info' => Color::Sky,
                'highlight' => Color::Fuchsia,
                'accent' => Color::Indigo,
                'neutral' => Color::Slate,
                'positive' => Color::Teal,
                'orange' => Color::Amber,
                'pink' => Color::Fuchsia,
                'teal' => Color::Teal,
                'yellow' => Color::Amber,
                'gray' => Color::Slate,
                'indigo' => Color::Indigo,
                'rose' => Color::Rose,
                'lime' => '#84cc16',
                'purple' => '#8b5cf6',
                'violet' => '#7c3aed',
                'cyan' => '#06b6d4',
            ])
            ->maxContentWidth('full')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                CustomAccountWidget::class,
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\LatestActivities::class,
                \App\Filament\Widgets\QuickActions::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            // ->darkMode(false)
            ->favicon('https://img.icons8.com/fluency/96/movie-projector.png')
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));

        // Add custom CSS for the admin panel
        FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => Blade::render("@vite('resources/css/admin.css')")
        );
    }
}
