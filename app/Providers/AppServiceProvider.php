<?php

namespace App\Providers;

use App\Contracts\{SettingsRepositoryInterface,
    SiteContentInterface,
    CategoryRepositoryInterface,
    AboutRepositoryInterface
};
use App\Models\{Language, Preparation, SiteContent, User};
use App\Observers\{LanguageObserver, PreparationObserver, SiteContentObserver};
use App\Listeners\{LogSuccessfulLogin, LogSuccessfulLogout};
use App\Contracts\LanguageRepositoryInterface;
use Illuminate\Support\Facades\{View, Route, URL, Event, Artisan, Schema, Hash};
use Illuminate\Auth\Events\{Login, Logout};
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        $this->registerObservers();

        $this->registerEventListeners();

        // Verilənlər bazası ilə bağlı ilkin quraşdırmalar
        $this->initializeDatabaseDefaults($languageRepository);

        // Dil tənzimləmələri
        $this->setupLanguageLocales();

        // View Composer (Blade üçün data)
        $this->registerViewComposers();

        $this->forceHttps();
    }


    /**
     * Observers qeydiyyatı
     */
    protected function registerObservers(): void
    {
        Language::observe(LanguageObserver::class);
        SiteContent::observe(SiteContentObserver::class);
        Preparation::observe(PreparationObserver::class);
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
            if (request()->is('admin*') || request()->is('nova-api*')) return;

            $route = Route::current();
            if (!$route) return;

            // 1. Dillər və Linklər
            $activeLanguages = cache('active_languages') ?? collect();
            $languageLinks = [];
            $currentRouteName = $route->getName() ?: 'home';
            $currentParameters = $route->parameters();

            foreach ($activeLanguages as $lang) {
                $languageLinks[$lang->code] = route($currentRouteName, array_merge($currentParameters, ['locale' => $lang->code]));
            }

            $setting = app(SettingsRepositoryInterface::class)->getSettings();
            $siteContent = app(SiteContentInterface::class)->getAllContent();
            $allCategories = app(CategoryRepositoryInterface::class)->getRandomActiveCategories();


            $view->with([
                'languages' => $activeLanguages,
                'languageLinks' => $languageLinks,
                'setting' => $setting,       // Avtomatik getdi
                'siteContent' => $siteContent,   // Avtomatik getdi
                'allCategories' => $allCategories, // Avtomatik getdi
            ]);
        });
    }

    /**
     * @return void
     */
    public function forceHttps(): void
    {
        if (app()->environment('production') || env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }
    }

}
