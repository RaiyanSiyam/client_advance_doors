<?php

use Illuminate\Support\Facades\Route;

// Public Site Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontCategoryController;

// Admin Panel Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerAuthController;

// ==========================================
// 1. PUBLIC SHOP ROUTES
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [FrontCategoryController::class, 'show'])->name('category.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// 1. Customer Authentication Routes
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// 2. Profile Dashboard Routes (Protected by Auth Middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/addresses', [ProfileController::class, 'storeAddress'])->name('profile.address.store');
    Route::delete('/profile/addresses/{address}', [ProfileController::class, 'destroyAddress'])->name('profile.address.destroy');
});

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

Route::get('/search-suggestions', function (\Illuminate\Http\Request $request) {
    if (!$request->filled('q')) return response()->json([]);
    
    // Grabs active products where name matches the search query (Limit to 5 to keep the dropdown clean)
    $products = \App\Models\Product::where('is_active', 1)
        ->where('name', 'like', '%' . $request->q . '%')
        ->select('id', 'name', 'slug', 'image', 'price', 'sale_price')
        ->take(5)
        ->get();
        
    return response()->json($products);
});

