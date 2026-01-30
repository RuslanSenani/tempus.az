<?php

namespace App\Providers;

use App\Contracts\MedicalInfoRepositoryInterface;
use App\Repository\MedicalInfoRepository;
use Illuminate\Support\ServiceProvider;

class MedicalInfoServicesProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MedicalInfoRepositoryInterface::class, MedicalInfoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
