<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Placeholder routes for Shop pages (we will build these later)
Route::get('/shop', function () { return 'Shop Page Coming Soon'; })->name('shop');
Route::get('/cart', function () { return 'Cart Page Coming Soon'; })->name('cart');