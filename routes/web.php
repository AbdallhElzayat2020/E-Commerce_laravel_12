<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Route::get('/', [HomeController::class, 'index'])->name('home');


        /* ========================== Protected Routes ========================== */
        Route::middleware(['auth'])->prefix('website')->as('website.')->group(function () {

            Route::get('user-profile', [ProfileController::class, 'index'])->name('profile.index');


        });
        /* ========================== Protected Routes ========================== */


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
