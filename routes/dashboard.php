<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        ######################## Guest Routes #########################
        Route::middleware(['guest'])->group(function () {

            ####################### Auth Routes #########################
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [LoginController::class, 'login'])->name('login.post');


        });


        ####################### Protected Routes #########################
        Route::middleware(['auth:admin', 'verified'])->group(function () {

            ####################### Home Route #########################
            Route::get('/admin/home', [HomeController::class, 'index'])->name('home');

        });


    }
);
