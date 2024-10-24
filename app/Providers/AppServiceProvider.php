<?php

namespace App\Providers;

use App\Http\Controllers\AuthController;
use App\Services\User\AuthenticationService;
use App\Services\User\AuthenticationServiceInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(AuthController::class)
            ->needs(AuthenticationServiceInterface::class)
            ->give(function () {
                return new AuthenticationService();
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function () {
            return Limit::perMinute(60)->by(request()->user()?->id ?: request()->ip());
        });
    }
}
