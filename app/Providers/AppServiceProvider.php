<?php

namespace App\Providers;

use App\Models\Admin;
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
            $view->with('pages', cache()->remember('header_pages', 3600, function () {
                return Page::latest()->get();
            }));
        });

        foreach (config('permissions_en') as $config_permission => $value) {
            Gate::define($config_permission, function ($auth) use ($config_permission) {
                // Only Admin users have the hasAccess method
                if ($auth instanceof Admin) {
                    return $auth->hasAccess($config_permission);
                }
                // Regular users don't have admin permissions
                return false;
            });
        }
    }
}
