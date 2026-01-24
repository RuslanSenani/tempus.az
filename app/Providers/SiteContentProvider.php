<?php

namespace App\Providers;

use App\Contracts\SiteContentInterface;
use App\Repository\SiteContentRepository;
use Illuminate\Support\ServiceProvider;

class SiteContentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SiteContentInterface::class, SiteContentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
