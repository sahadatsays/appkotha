<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DownloadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Frontend)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{caseStudy:slug}', [PageController::class, 'portfolioShow'])->name('portfolio.show');

// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{service:slug}', [ServiceController::class, 'show'])->name('show');
});

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
});

// Contact
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::get('/quote', [ContactController::class, 'quote'])->name('quote');
    Route::post('/quote', [ContactController::class, 'storeQuote'])->name('quote.store');
    Route::get('/success', [ContactController::class, 'success'])->name('success');
    Route::get('/demo', [ContactController::class, 'demo'])->name('demo');
    Route::post('/demo', [ContactController::class, 'storeDemoRequest'])->name('demo.store');
});

// Terms and Privacy
Route::get('/terms', function () {
    return view('pages.terms');
})->name('pages.terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('pages.privacy');

/*
|--------------------------------------------------------------------------
| E-Commerce Routes
|--------------------------------------------------------------------------
*/

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'count'])->name('count');
    Route::get('/mini', [CartController::class, 'mini'])->name('mini');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'process'])->name('process');
    Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('confirmation');
    Route::match(['get', 'post'], '/lookup', [CheckoutController::class, 'lookup'])->name('lookup');
});

// License Verification API (public)
Route::prefix('api/license')->name('api.license.')->group(function () {
    Route::post('/verify', [DownloadController::class, 'verifyLicense'])->name('verify');
    Route::post('/activate', [DownloadController::class, 'activateLicense'])->name('activate');
});

// Guest Downloads (via order)
Route::get('/order/{order}/download/{license}', [DownloadController::class, 'guestDownload'])
    ->name('order.download');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Downloads
    Route::prefix('downloads')->name('downloads.')->group(function () {
        Route::get('/', [DownloadController::class, 'index'])->name('index');
        Route::get('/{license}', [DownloadController::class, 'download'])->name('download');
        Route::get('/{license}/file/{file}', [DownloadController::class, 'downloadFile'])->name('file');
    });
});

// Change from this (if it has restrictive middleware):
Route::get('/checkout/confirmation/{id}', [CheckoutController::class, 'confirmation'])
    ->name('checkout.confirmation')
    ->middleware(['signed']);

require __DIR__.'/auth.php';
