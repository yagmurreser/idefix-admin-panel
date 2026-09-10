<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;


Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    /*
    Users API
    */

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/users/{id}', [UserController::class, 'show']);

    Route::post('/users', [UserController::class, 'store']);

    Route::put('/users/{id}', [UserController::class, 'update']);

    Route::delete('/users/{id}', [UserController::class, 'destroy']);


    /*
    Products API
    */

    Route::get('/products', [ProductController::class, 'index']);

    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::post('/products', [ProductController::class, 'store']);

    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);


    /*
    Categories API
    */

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    Route::post('/categories', [CategoryController::class, 'store']);

    Route::put('/categories/{id}', [CategoryController::class, 'update']);

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);


    /*
     Orders API
    */

    Route::post('/orders', [OrderController::class, 'store']);

    Route::get('/orders/{orderNumber}', [OrderController::class, 'show']);


    /*
    Logout
    */

    Route::post('/logout', [AuthController::class, 'logout']);
});