<?php

namespace App\Providers;

use App\Contracts\LanguageRepositoryInterface;
use App\Models\Language;
use App\Models\SiteContent;
use App\Models\User;
use App\Observers\LanguageObserver;
use App\Observers\SiteContentObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;

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

        Paginator::useBootstrap();
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
            if (!User::exists()) {
                User::create([
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('12345678'),
                    'is_admin' => 1
                ]);
            }
        }


        Event::listen(
            Login::class,
            LogSuccessfulLogin::class
        );

        Event::listen(
            Logout::class,
            LogSuccessfulLogout::class
        );



    }


}
