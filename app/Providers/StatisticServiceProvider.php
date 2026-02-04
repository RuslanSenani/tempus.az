<?php

namespace App\Providers;

use App\Contracts\StatisticRepositoryInterface;
use App\Repository\StatisticRepository;
use Illuminate\Support\ServiceProvider;

class StatisticServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StatisticRepositoryInterface::class, StatisticRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
