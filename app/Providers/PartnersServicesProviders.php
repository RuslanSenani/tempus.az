<?php

namespace App\Providers;

use App\Contracts\PartnersRepositoryInterface;
use App\Repository\PartnersRepository;
use Illuminate\Support\ServiceProvider;

class PartnersServicesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PartnersRepositoryInterface::class, PartnersRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
