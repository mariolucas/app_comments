<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         /*
         Utilizando a middlware personalizada para fazer o 
         gerenciamento do que pode ou não ser mostado quando autenticado
         */

        Blade::if('authJwtWeb', function () {
            return isset($_COOKIE['api_token']) && !empty($_COOKIE['api_token']);
        });

        Blade::if('guestJwtWeb', function () {
            return !isset($_COOKIE['api_token']) || empty($_COOKIE['api_token']);
        });
    }
}
