<?php

namespace App\Providers;

use App\Models\{Language, SiteContent, User};
use App\Observers\{LanguageObserver, SiteContentObserver};
use App\Listeners\{LogSuccessfulLogin, LogSuccessfulLogout};
use App\Contracts\LanguageRepositoryInterface;
use Illuminate\Support\Facades\{View, Route, URL, Event, Artisan, Schema, Hash};
use Illuminate\Auth\Events\{Login, Logout};
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

//use App\Contracts\LanguageRepositoryInterface;
//use App\Models\Language;
//use App\Models\SiteContent;
//use App\Models\User;
//use App\Observers\LanguageObserver;
//use App\Observers\SiteContentObserver;
//use Illuminate\Pagination\Paginator;
//use Illuminate\Support\Facades\Artisan;
//use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Schema;
//use Illuminate\Support\Facades\URL;
//use Illuminate\Support\Facades\View;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Event;
//use Illuminate\Auth\Events\Login;
//use Illuminate\Auth\Events\Logout;
//use App\Listeners\LogSuccessfulLogin;
//use App\Listeners\LogSuccessfulLogout;

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

        $this->registerObservers();

        $this->registerEventListeners();

        // Verilənlər bazası ilə bağlı ilkin quraşdırmalar
        $this->initializeDatabaseDefaults($languageRepository);

        // Dil tənzimləmələri
        $this->setupLanguageLocales();

        // View Composer (Blade üçün data)
        $this->registerViewComposers();
    }


    /**
     * Observers qeydiyyatı
     */
    protected function registerObservers(): void
    {
        Language::observe(LanguageObserver::class);
        SiteContent::observe(SiteContentObserver::class);
    }

    /**
     * Login/Logout eventləri
     */
    protected function registerEventListeners(): void
    {
        Event::listen(Login::class, LogSuccessfulLogin::class);
        Event::listen(Logout::class, LogSuccessfulLogout::class);
    }

    /**
     * Database Seed və Admin User yaradılması
     */
    protected function initializeDatabaseDefaults($languageRepository): void
    {
        if (app()->runningInConsole()) return;

        // Dillər yoxdursa seed et
        if (Schema::hasTable('languages') && $languageRepository->count() === 0) {
            Artisan::call('db:seed', ['--class' => 'LanguageSeeder', '--force' => true]);
        }

        // Admin yoxdursa yarat
        if (Schema::hasTable('users') && !User::exists()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'is_admin' => 1
            ]);
        }
    }


    /**
     * Default dili bazadan götürüb konfiqurasiya edir
     */
    protected function setupLanguageLocales(): void
    {
        $activeLanguages = cache()->rememberForever('active_languages', function () {
            return app(LanguageRepositoryInterface::class)->getAllLanguages();
        });

        if ($activeLanguages && $activeLanguages->isNotEmpty()) {
            $defaultLang = $activeLanguages->where('is_default', 1)->first() ?? $activeLanguages->first();

            if ($defaultLang) {
                config(['app.locale' => $defaultLang->code]);
                URL::defaults(['locale' => $defaultLang->code]);
            }
        }
    }

    /**
     * Blade fayllarına avtomatik dataların göndərilməsi
     */
    protected function registerViewComposers(): void
    {
        View::composer('*', function ($view) {
            // Admin paneldirsə datanı yükləməyə ehtiyac yoxdur
            if (request()->is('admin*') || request()->is('nova-api*')) return;

            $route = Route::current();
            if (!$route) return;

            $activeLanguages = cache('active_languages') ?? collect();
            $languageLinks = [];

            $currentRouteName = $route->getName() ?: 'home';
            $currentParameters = $route->parameters();

            foreach ($activeLanguages as $lang) {
                $languageLinks[$lang->code] = route($currentRouteName, array_merge($currentParameters, ['locale' => $lang->code]));
            }

            $view->with([
                'languages' => $activeLanguages,
                'languageLinks' => $languageLinks
            ]);
        });
    }

}
