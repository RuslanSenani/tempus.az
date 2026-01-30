<?php

namespace App\Providers;

use App\Contracts\ContactMessageRepositoryInterface;
use App\Repository\ContactMessageRepository;
use Illuminate\Support\ServiceProvider;

class ContactMessageProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ContactMessageRepositoryInterface::class, ContactMessageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
