<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
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

            ####################### Reset Password Routes #########################
            Route::prefix('password')->name('password.')->group(function () {
                /* Forget Password */
                Route::controller(ForgetPasswordController::class)->group(function () {
                    Route::get('/forgot-password', 'forgotPassword')->name('forgot-password');
                    Route::post('/forgot-password', 'sendResetLinkEmail')->name('send-reset-link');

                    /* OTP Verification */
                    Route::get('show-otp-form/{email}/{token}', 'showOtpForm')->name('show-otp-form');
                    Route::post('verify-otp-form', 'verifyOtp')->name('verify-otp-form');
                });

                /* Reset Password */
                Route::controller(ResetPasswordController::class)->group(function () {
                    Route::get('/reset-password/{email}/{token}', 'showResetPasswordForm')->name('show-reset-password-form');
                    Route::post('/reset-password', 'ResetPassword')->name('reset-password');
                });
            });
        });


        ####################### Protected Routes #########################
        Route::middleware(['auth:admin', 'verified'])->group(function () {

            ####################### Home Route #########################
            Route::get('/admin/home', [HomeController::class, 'index'])->name('home');
            Route::post('logout', [LoginController::class, 'logout'])
                ->name('logout');
        });
    }
);
