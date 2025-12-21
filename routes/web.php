<?php

use App\Http\Controllers\Website\{CartController, CheckoutController, FaqController, ContactUsController, DynamicPageController, HomeController, ProfileController, CategoryController, BrandController, ProductController, ShopController, WishlistController};

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        /* ========================== Public Routes ========================== */

        Route::prefix('/')->as('website.')->group(function () {

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


            /* =============================== Products Routes =============================== */
            Route::controller(ProductController::class)
                ->prefix('products')->group(function () {

                    // all products per type {new arrival, featured, top-selling, flash-sale}
                    Route::get('/{type}', 'showProductsByType')
                        ->name('products.type');

                    // show product details
                    Route::get('/show/{slug}', 'showProductDetails')
                        ->name('product.show.details');

                    //related products
                    Route::get('/{slug}/related-products', 'getRelatedProducts')
                        ->name('related.products');
                });


            // shop Route
            Route::get('/shop', [ShopController::class, 'showShopPage'])
                ->name('shop');
        });

        /* ========================== Public Routes ========================== */


        /* ========================== Protected Routes  ========================== */
        Route::middleware(['auth:web'])->prefix('website')->as('website.')->group(function () {

            // profile Route
            Route::get('/user-profile', [ProfileController::class, 'index'])
                ->name('profile.index');

            // Wishlist Route
            Route::get('/wishlist', WishlistController::class)
                ->name('wishlist');

            // cart Route
            Route::get('/cart', [CartController::class, 'index'])
                ->name('cart');

            // checkout Route
            Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])
                ->name('checkout.index');

            Route::post('/checkout', [CheckoutController::class, 'checkout'])
                ->name('checkout.post');


            Route::get('/test', function () {
                $response = Http::withHeaders(['Authorization' => 'Bearer SK_KWT_vVZlnnAqu8jRByOWaRPNId4ShzEDNt256dvnjebuyzo52dXjAfRx2ixW5umjWSUx'])
                    ->timeout(30)
                    ->withoutVerifying()
                    ->acceptJson()
                    ->send('POST', 'https://apitest.myfatoorah.com/v2/SendPayment', [
                        'json' => [
                            'InvoiceValue' => 1000,
                            'CustomerName' => 'fname lname',
                            'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
                            'DisplayCurrencyIso' => 'EGP',
                            'MobileCountryCode' => '+20',
                            'CustomerMobile' => '0123433455',
                            'CustomerEmail' => 'email@gmail.com',
                            'CallBackUrl' => 'http://localhost:8000/test/callback',
                            'ErrorUrl' => 'http://localhost:8000/test/error',
                        ],
                    ]);
                // create order  && create transaction  user_id , order_id , invoice_id


                return redirect($response['Data']['InvoiceURL']);
            });
        });
        /* ========================== Protected Routes ========================== */


        // Auth Routes from Breeze
        require __DIR__ . '/auth.php';

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware(config('livewire.middleware_group', 'web'));
        });
    }
);

Route::get('test/callback', function () {
    $response = Http::withHeaders(['Authorization' => 'Bearer SK_KWT_vVZlnnAqu8jRByOWaRPNId4ShzEDNt256dvnjebuyzo52dXjAfRx2ixW5umjWSUx'])
        ->timeout(30)
        ->withoutVerifying()
        ->send('POST', 'https://apitest.myfatoorah.com/v2/GetPaymentStatus', [
            'json' => [
                'Key' => request()->paymentId,
                'KeyType' => 'PaymentId'
            ],
        ]);

    // change order status to paid
    // clear cart and send notification
    return $response;
});

Route::get('test/error', function () {
    return response()->json(request()->all());
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])->name('dashboard');


/*
  * endpoint :https://apitest.myfatoorah.com/v2/SendPayment
  * method   : POST
  * headers  : Authorization => Bearer SK_KWT_vVZlnnAqu8jRByOWaRPNId4ShzEDNt256dvnjebuyzo52dXjAfRx2ixW5umjWSUx
  *
  *
  //Fill required data
 'InvoiceValue'       => $invoiceValue,
 'CustomerName'       => 'fname lname',
 'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
     //Fill optional data
     //'DisplayCurrencyIso' => $displayCurrencyIso,
     //'MobileCountryCode'  => $phone[0],
     //'CustomerMobile'     => $phone[1],
     //'CustomerEmail'      => 'email@example.com',
     //'CallBackUrl'        => 'https://example.com/callback.php',
     //'ErrorUrl'           => 'https://example.com/callback.php', //or 'https://example.com/error.php'
     //'Language'           => 'en', //or 'ar'
     //'CustomerReference'  => 'orderId',
     //'CustomerCivilId'    => 'CivilId',
     //'UserDefinedField'   => 'This could be string, number, or array',
     //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
     //'CustomerAddress'    => $customerAddress,
     //'InvoiceItems'       => $invoiceItems,
     //'Suppliers'          => $suppliers,
  */


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});


//require __DIR__ . '/dashboard.php';
