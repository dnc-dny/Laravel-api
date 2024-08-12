<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        Route::prefix('api')
        ->middleware('api')
        ->namespace('App\Http\Controllers')
        ->group(base_path('routes/api.php'));
        Route::middleware('web')
        ->namespace('App\Http\Controllers')
        ->group(base_path('routes/web.php'));

        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
