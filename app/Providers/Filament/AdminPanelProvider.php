<?php

namespace App\Providers\Filament;

use App\Models\Accueil;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        try {
            $pageAccueil = Accueil::first();
            return $panel
                ->default()
                ->id('admin')
                ->path('admin')
                ->login()
                ->colors([
                    'primary' => Color::Blue,
                    'gray' => Color::Slate,
                ])
                ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
                ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
                ->pages([
                    Pages\Dashboard::class,
                ])
                ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
                ->widgets([
                    Widgets\AccountWidget::class,
                ])
                ->navigationGroups([
                    'Contenu éditorial',
                    'Outils',
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
                ->authMiddleware([
                    Authenticate::class,
                ])
                ->plugins([
                    SpatieLaravelTranslatablePlugin::make()
                        ->defaultLocales(config('languages')),
                ])
                ->navigationGroups([

                    NavigationGroup::make()
                        ->label('Articles')
                        ->icon('heroicon-o-pencil')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Pages')
                        ->icon('heroicon-o-book-open')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Références')
                        ->icon('heroicon-o-tag')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Formulaires')
                        ->icon('heroicon-o-envelope')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Media')
                        ->icon('heroicon-o-rectangle-group')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Configuration')
                        ->icon('heroicon-o-cog-8-tooth')
                        ->collapsed(),

                    NavigationGroup::make()
                        ->label('Utilisateurs')
                        ->icon('heroicon-o-user-group')
                        ->collapsed(),

                ])
                ->navigationItems([
                    NavigationItem::make('Aller au site')
                        ->url('/')
                        ->icon('heroicon-o-globe-europe-africa')
                        ->sort(-3),
                    NavigationItem::make('Page d\'accueil')
                        ->url($pageAccueil ? '/admin/accueils/' . $pageAccueil->id . '/edit' : '/admin/accueils/create') // La génération de l'url à partir de la resource ne fonctionne pas
                        ->group('Pages'),
                ])
                ->sidebarCollapsibleOnDesktop();
        } catch (\Exception $e) {
            return $panel
                ->default()
                ->id('admin')
                ->path('admin');
        }
    }
}
