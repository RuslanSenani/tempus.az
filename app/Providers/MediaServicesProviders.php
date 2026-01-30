<?php

namespace App\Providers;

use App\Contracts\MediaRepositoryInterface;
use App\Repository\MediaRepository;
use Illuminate\Support\ServiceProvider;

class MediaServicesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
