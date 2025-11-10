<?php

use App\Http\Controllers\Dashboard\ContactController;
use Livewire\Livewire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Dashboard\{FaqController, HomeController, PageController, RoleController, SliderController, UserController, AdminController, BrandController, WorldController, CouponController, ProductController, SettingController, CategoryController, AttributeController};


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\{
    LoginController,
    ResetPasswordController,
    ForgetPasswordController,
};

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

            ####################### Shipping & Countries Route #########################
            Route::group(['middleware' => 'can:global_shipping'], function () {
                Route::controller(WorldController::class)->group(function () {

                    Route::prefix('countries')->name('countries.')->group(function () {
                        Route::get('/', 'getAllCountries')->name('index');
                        Route::get('/{country_id}/governorates', 'getGovsByCountry')->name('governorates.index');
                        Route::get('/change-status/{country_id}', 'changeStatus')->name('status');
                    });

                    Route::prefix('governorates')->name('governorates.')->group(function () {
                        Route::get('/change-status/{gov_id}', 'changeGovStatus')->name('status');
                        Route::put('/shipping-price', 'changeShippingPrice')->name('shipping-price');
                    });
                });
            });
            ####################### Shipping & Countries Route #########################

            ####################### Categories Route #########################
            Route::group(['middleware' => 'can:categories'], function () {
                Route::resource('categories', CategoryController::class)->except('show');

                Route::get('categories-all', [CategoryController::class, 'getAllCategories'])
                    ->name('categories.all');

                Route::post('categories/update-status', [CategoryController::class, 'updateStatus'])
                    ->name('categories.update-status');
            });
            ####################### Categories Route #########################


            ####################### Brands Route #########################
            Route::group(['middleware' => 'can:brands'], function () {
                Route::resource('brands', BrandController::class)->except(['show']);

                Route::get('brands-all', [BrandController::class, 'getAll'])
                    ->name('brands.all');
            });
            ####################### Brands Route #########################

            ####################### Coupon Route #########################
            Route::group(['middleware' => 'can:coupons'], function () {
                Route::resource('coupons', CouponController::class)->except(['show']);

                Route::get('coupons-all', [CouponController::class, 'getAll'])
                    ->name('coupons.all');
            });
            ####################### Coupon Route #########################

            ####################### Faqs Route #########################
            Route::group(['middleware' => 'can:faqs'], function () {
                Route::resource('faqs', FaqController::class)->except(['show']);
            });
            ####################### Faqs Route #########################

            ####################### Settings Route #########################
            Route::group(['middleware' => 'can:settings'], function () {
                Route::resource('settings', SettingController::class)->except(['show']);
            });
            ####################### Settings Route #########################

            ####################### Attributes Route #########################
            Route::group(['middleware' => 'can:attributes'], function () {
                Route::resource('attributes', AttributeController::class)->except(['show']);

                Route::get('attributes-all', [AttributeController::class, 'getAll'])
                    ->name('attributes.all');
            });
            ####################### Attributes Route #########################

            ####################### Products Route #########################
            Route::group(['middleware' => 'can:products'], function () {

                Route::resource('products', ProductController::class);
                Route::post('products/update-status', [ProductController::class, 'updateStatus'])->name('products.update-status');

                Route::get('products-all', [ProductController::class, 'getAll'])
                    ->name('products.all');

                Route::post('product/variants/{variant}', [ProductController::class, 'deleteVariant'])->name('products.variants.delete');
            });
            ####################### Products Route #########################

            ####################### Users Route #########################
            Route::group(['middleware' => 'can:users'], function () {

                Route::resource('users', UserController::class);
                Route::post('users/update-status', [UserController::class, 'updateStatus'])->name('users.update-status');

                Route::get('users-all', [UserController::class, 'getAll'])
                    ->name('users.all');
            });
            ####################### Users Route #########################

            ####################### Contacts Route #########################
            Route::group(['middleware' => 'can:contacts'], function () {

                Route::get('contacts', [ContactController::class, 'index'])
                    ->name('contacts.index');
            });
            ####################### Contacts Route #########################


            ####################### Sliders Route #########################
            Route::group(['middleware' => 'can:sliders'], function () {

                Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
                Route::post('slider', [SliderController::class, 'store'])->name('sliders.store');
                Route::get('slider-all', [SliderController::class, 'getAll'])->name('sliders.all');
                Route::get('slider/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
                Route::put('slider/{id}', [SliderController::class, 'update'])->name('sliders.update');
                Route::get('remove/{id}', [SliderController::class, 'destroy'])->name('sliders.delete');
            });

            ####################### Sliders Route #########################

            ####################### Pages Route #########################
            Route::group(['middleware' => 'can:pages'], function () {

                Route::resource('pages', PageController::class);

                Route::get('pages-all', [PageController::class, 'getAll'])
                    ->name('pages.all');
            });
            ####################### Pages Route #########################

            // livewire Localized Routes
            //            Livewire::setUpdateRoute(function ($handle) {
            //                return Route::post('/livewire/update', $handle);
            //            });
        });
    }
);
