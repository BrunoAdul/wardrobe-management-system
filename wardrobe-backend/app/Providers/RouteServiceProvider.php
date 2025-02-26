<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel to redirect users after login.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->configureRoutes();
    }

    /**
     * Configure the application's route definitions.
     */
    protected function configureRoutes(): void
    {
        $this->routes(function () {
            // ✅ Load API routes with /api prefix
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // ✅ Load web routes (frontend pages)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
