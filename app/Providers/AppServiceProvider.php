<?php

namespace App\Providers;

use App\Contracts\LanguageRepositoryInterface;
use App\Models\Language;
use App\Models\SiteContent;
use App\Models\User;
use App\Observers\LanguageObserver;
use App\Observers\SiteContentObserver;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(LanguageRepositoryInterface $languageRepository): void
    {

        Language::observe(LanguageObserver::class);
        SiteContent::observe(SiteContentObserver::class);

        if (!app()->runningInConsole()) {

            if ($languageRepository->count() === 0) {

                Artisan::call('db:seed', [
                    '--class' => 'LanguageSeeder',
                    '--force' => true
                ]);
            }
        }

        if (Schema::hasTable((new Language())->getTable())) {
            User::firstOrCreate(
                ['email' => 'admin@admin.com'],
                [
                    'name' => 'admin',
                    'password' => Hash::make('12345678'),
                    'is_admin' => true
                ]
            );
        }


    }


}
