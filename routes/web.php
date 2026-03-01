<?php

use Illuminate\Support\Facades\Route;

// Public Site Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Admin Panel Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;

// ==========================================
// 1. PUBLIC SHOP ROUTES
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');


// ==========================================
// 2. ADMIN PORTAL ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // --> Guest Admin Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // --> Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        
        // Admin Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Admin Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Categories (Creates index, create, store, edit, update, destroy)
        Route::resource('categories', CategoryController::class);

        // Products (Creates index, create, store, edit, update, destroy)
        Route::resource('products', ProductManageController::class);
        
        // Orders 
        Route::resource('orders', OrderController::class)->except(['create', 'store', 'destroy']);
        
    });
});