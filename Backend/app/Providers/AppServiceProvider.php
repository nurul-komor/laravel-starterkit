<?php

namespace App\Providers;

use App\Contracts\AuthenticatorInterface;
use App\Contracts\GetAuthenticatedUserInterface;
use App\Contracts\TokenGeneratorInterface;
use App\Services\AuthenticatorService;
use App\Services\GetAuthenticatedUserService;
use App\Services\TokenGeneratorService;
use Illuminate\Support\ServiceProvider;

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
        // $this->app->bind(AuthenticatorInterface::class, AuthenticatorService::class);
        // $this->app->bind(GetAuthenticatedUserInterface::class, GetAuthenticatedUserService::class);
        // $this->app->bind(TokenGeneratorInterface::class, TokenGeneratorService::class);
    }
}
