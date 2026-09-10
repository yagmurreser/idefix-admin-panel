<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerShopController;
use App\Http\Controllers\CustomerCartController;
use App\Http\Controllers\CustomerCheckoutController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\AdminOrderController;
use Illuminate\Support\Facades\Route;


/*
 Authentication
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
 Customer Registration
*/

Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])
    ->name('customer.register');

Route::post('/customer/register', [CustomerAuthController::class, 'register'])
    ->name('customer.register.submit');


/*
 Admin Routes
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    | Dashboard
    */

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    /*
    | Admin Orders
    */

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])
        ->name('admin.orders.show');


    /*
    | Admin Categories
    */

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('admin.categories.edit');

    Route::get('/admin/categories/{category}/delete', [CategoryController::class, 'delete'])
        ->name('admin.categories.delete');

    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');


    /*
    | Admin Users
    */

    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/create', [AdminUserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/users', [AdminUserController::class, 'store'])
        ->name('admin.users.store');

    Route::delete('/admin/users', [AdminUserController::class, 'bulkDelete'])
        ->name('admin.users.bulkDelete');

    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');

    Route::get('/admin/users/{user}/delete', [AdminUserController::class, 'delete'])
        ->name('admin.users.delete');


    /*
    | Admin Products
    */

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.products.index');

    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('admin.products.edit');

    Route::get('/admin/products/{product}/delete', [ProductController::class, 'delete'])
        ->name('admin.products.delete');

    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])
        ->name('admin.products.destroy');

    Route::put('/admin/products/{product}', [ProductController::class, 'update'])
        ->name('admin.products.update');
});


/*
Customer Routes
*/

Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/shop', [CustomerShopController::class, 'index'])
        ->name('customer.shop');

    Route::get('/cart', [CustomerCartController::class, 'index'])
        ->name('customer.cart.index');

    Route::post('/cart/add/{product}', [CustomerCartController::class, 'add'])
        ->name('customer.cart.add');

    Route::delete('/cart/remove/{product}', [CustomerCartController::class, 'remove'])
        ->name('customer.cart.remove');

    Route::post('/checkout', [CustomerCheckoutController::class, 'store'])
        ->name('customer.checkout.store');

    Route::get('/my-orders', [CustomerOrderController::class, 'index'])
        ->name('customer.orders.index');

    Route::get('/my-orders/{orderNumber}', [CustomerOrderController::class, 'show'])
        ->name('customer.orders.show');

    Route::post('/customer/logout', [LoginController::class, 'logout'])
        ->name('customer.logout');
});