<?php

namespace App\Providers;

use App\Contracts\PreparationRepositoryInterface;
use App\Repository\PreparationRepository;
use Illuminate\Support\ServiceProvider;

class PreparationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(PreparationRepositoryInterface::class, PreparationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
