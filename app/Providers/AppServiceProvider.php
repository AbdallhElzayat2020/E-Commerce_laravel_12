<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {

        Paginator::useBootstrap();

        View::composer('frontend.layouts.header', function ($view) {
            $view->with('pages', Page::latest()->get());
        });

        foreach (config('permissions_en') as $config_permission => $value) {
            Gate::define($config_permission, function ($auth) use ($config_permission) {
                return $auth->hasAccess($config_permission);
            });
        }
    }
}
