<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::middleware('auth')->group(function () {
    
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

     Route::get('/dashboard', function () {
        return view('dashboard');
    })  ->name('dashboard');

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

    
});