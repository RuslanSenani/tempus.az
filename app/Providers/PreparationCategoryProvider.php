<?php

namespace App\Providers;

use App\Contracts\PreparationCategoryRepositoryInterface;
use App\Repository\PreparationCategoryRepository;
use Illuminate\Support\ServiceProvider;

class PreparationCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PreparationCategoryRepositoryInterface::class, PreparationCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
