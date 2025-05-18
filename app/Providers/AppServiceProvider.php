<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

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
        // Force HTTPS en production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Définir la longueur par défaut des chaînes de caractères
        Schema::defaultStringLength(191);

        // Enregistrer les composants Blade personnalisés
        Blade::component('layouts.app', 'app-layout');
        Blade::component('layouts.guest', 'guest-layout');

        // Définir les gates d'autorisation
        Gate::define('admin', function ($user) {
            return $user->is_admin;
        });
    }
}
