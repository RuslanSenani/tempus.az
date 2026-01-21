<?php

namespace App\Providers;

use App\Contracts\AboutRepositoryInterface;
use App\Repository\AboutRepository;
use Illuminate\Support\ServiceProvider;

class AboutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
