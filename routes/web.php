<?php

use App\Http\Controllers\Website\{
    FaqController,
    ContactUsController,
    DynamicPageController,
    HomeController,
    ProfileController,
    CategoryController,
    BrandController,
    ProductController,
    ShopController,
};

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        /* ========================== Protected Routes  ========================== */

        Route::middleware(['auth'])->prefix('website')->as('website.')->group(function () {

            Route::get('user-profile', [ProfileController::class, 'index'])
                ->name('profile.index');
        });

        /* ========================== Protected Routes ========================== */

        /* ========================== Public Routes ========================== */

        Route::prefix('/')->middleware(['guest'])->as('website.')->group(function () {

            // Home
            Route::get('/', [HomeController::class, 'index'])
                ->name('home');

            // contact us
            Route::get('contact-us', [ContactUsController::class, 'showContactUsPage'])
                ->name('contact-us');

            // faqs
            Route::get('faqs', [FaqController::class, 'showFaqPage'])
                ->name('faqs.index');

            // dynamic Pages Route
            Route::get('page/{slug}', [DynamicPageController::class, 'showDynamicPage'])
                ->name('dynamic-page');

            // categories
            Route::controller(CategoryController::class)->group(function () {
                Route::get('categories', 'showCategoryPage')
                    ->name('categories.index');
                // products by category
                Route::get('category/{slug}', 'getProductsByCategory')
                    ->name('category.products');
            });

            // brands
            Route::controller(BrandController::class)->group(function () {
                Route::get('brands', 'showBrandPage')
                    ->name('brands.index');
                // products by brand
                Route::get('brand/{slug}', 'getProductsByBrand')
                    ->name('brand.products');
            });


            /* Products Routes */

            Route::controller(ProductController::class)
                ->prefix('products')->group(function () {

                    // all products per type {new arrival, featured, top-selling, flash-sale}
                    Route::get('/{type}', 'showProductsByType')
                        ->name('products.type');

                    // show product details
                    Route::get('/show/{slug}', 'showProductDetails')
                        ->name('product.show.details');

                    Route::get('/{slug}/related-products', 'getRelatedProducts')->name('related.products');
                });


            // shop Route
            Route::get('/shop', [ShopController::class, 'showShopPage'])->name('shop');

        });

        /* ========================== Public Routes ========================== */


        // Auth Routes from Breeze
        require __DIR__ . '/auth.php';

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
    }
);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});


//require __DIR__ . '/dashboard.php';
