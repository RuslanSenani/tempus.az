<?php

namespace App\Providers;

use App\Contracts\VacancyApplicationRepositoryInterface;
use App\Contracts\VacancyRepositoryInterface;
use App\Repository\VacancyApplicationRepository;
use App\Repository\VacancyRepository;
use Illuminate\Support\ServiceProvider;

class VacancyServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VacancyRepositoryInterface::class, VacancyRepository::class);
        $this->app->bind(VacancyApplicationRepositoryInterface::class, VacancyApplicationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
