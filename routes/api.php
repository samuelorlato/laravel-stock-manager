<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register'])->name('api_register');
Route::post('/login', [AuthController::class, 'login'])->name('api_login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('api_list_products');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('api_show_product');
    Route::post('/product', [ProductController::class, 'store'])->name('api_create_product');
    Route::patch('/product/{id}', [ProductController::class, 'update'])->name('api_update_product');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('api_delete_product');
});