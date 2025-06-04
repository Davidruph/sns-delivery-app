<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StoreSettingsController;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache cleared';
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('register', [AuthController::class, 'create'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('register.post');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware(['auth'])->group(function () {
    Route::post('broadcasting/auth', [AuthController::class, 'socket_authenticate'])->name('socket_auth');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{cat}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{cat}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/category/{cat}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('/store-settings', [StoreSettingsController::class, 'index'])->name('store.index');
        Route::post('/store-settings', [StoreSettingsController::class, 'update'])->name('store.update');

        Route::get('/new-signup-request', [UserController::class, 'signup_request'])->name('users.signup_request');
        Route::post('/signup-request-status/{user}', [UserController::class, 'signup_request_status'])->name('users.signup_request_status');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::middleware(['role:Super Admin|Portal Manager|Customer Service'])->group(function () {
        Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
        Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
        Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store');
        Route::get('/vendors/{user}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::post('/vendors/update/{user}', [VendorController::class, 'update'])->name('vendors.update');
        Route::post('/vendors/{user}', [VendorController::class, 'destroy'])->name('vendors.destroy');
    });

    Route::middleware(['role:Super Admin|Portal Manager|Customer Service|Vendor'])->group(function () {
        Route::get('/orders/view/all', [OrderController::class, 'view_all_orders'])->name('order.view.all');
        Route::post('/order/{order}/status', [OrderController::class, 'change_order_status'])->name('order.status');
        Route::get('/order/{order}/view', [OrderController::class, 'view'])->name('order.view');
        Route::get('/inventory/all', [InventoryController::class, 'view_all_inventory'])->name('inventory.view.all');
    });

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    Route::middleware(['role:Vendor'])->group(function () {
        Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::post('/inventory/update/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::post('/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/order', [OrderController::class, 'store'])->name('order.store');
        Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('/order/update/{order}', [OrderController::class, 'update'])->name('order.update');
        Route::post('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    });

    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');
});
