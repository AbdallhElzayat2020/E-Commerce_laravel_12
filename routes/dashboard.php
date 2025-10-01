<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
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
                    Route::post('resend-otp', 'resendOtp')->name('resend-otp');
                });

                /* Reset Password */
                Route::controller(ResetPasswordController::class)->group(function () {
                    Route::get('/reset-password/{email}/{token}', 'showResetPasswordForm')->name('show-reset-password-form');
                    Route::post('/reset-password', 'ResetPassword')->name('reset-password');
                });
            });
            ####################### End Reset Password Routes #########################
        });
        ######################## End Guest Routes #########################


        ####################### Protected Routes #########################
        Route::middleware(['auth:admin', 'verified'])->group(function () {

            ####################### Home Route #########################
            Route::get('/admin/home', [HomeController::class, 'index'])
                ->name('home');

            Route::post('logout', [LoginController::class, 'logout'])
                ->name('logout');

            ####################### Roles Route #########################
            Route::middleware(['can:roles'])->group(function () {
                Route::resource('roles', RoleController::class);
                Route::post('roles/update-status', [RoleController::class, 'updateStatus'])->name('roles.update-status');;
            });
            ####################### End Roles Route #########################


            ####################### Admins Route #########################
            Route::middleware(['can:admins'])->group(function () {
                Route::resource('admins', AdminController::class);
                Route::post('admins/update-status', [AdminController::class, 'updateStatus'])->name('admins.update-status');;
            });
            ####################### End Admins  #########################


        });
    }
);
