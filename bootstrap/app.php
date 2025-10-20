<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(__DIR__ . '/../routes/dashboard.php');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);

        /*
         * redirect Guest and Users
         */
        $middleware->redirectGuestsTo(function () {
            if (request()->is('*/dashboard/*')) {
                return route('dashboard.login');
            }
            return route('login');
        });

        /*
         * redirect Admins
         */
        $middleware->redirectUsersTo(function () {
            if (Auth::guard('admin')->check()) {
                return route('dashboard.home');
            }
            return redirect()->to('/');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
