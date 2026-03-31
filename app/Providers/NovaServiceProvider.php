<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        parent::boot();

        Nova::initialPath(function ($request) {
            $user = $request->user();
            if ($user) {
                if ($user->is_admin) {
                    return '/resources/activity-logs';
                }
                return '/resources/users/' . $user->id;

            }
            return '/login';
        });

        // Footer-i özəlləşdiririk
        Nova::footer(function ($request) {
            return Blade::render('
        <div class="flex justify-center gap-1 text-xs">
            <p class="text-center">
                &copy; {{ date("Y") }}
                <a href="{{ route("home") }}" class="link-default">Tempus</a>.
                {{ __("All rights reserved.") }}
            </p>
        </div>
    ');
        });

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {

        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->register();

        Route::get('/admin', function () {
            return redirect('/admin/resources/activity-logs');
        });
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
//            new \App\Nova\Dashboards\Main,

        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
