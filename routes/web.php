<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


// Admin Login Routes
Route::get('admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login');


Route::get('index', [ProductController::class, 'index'])->name('index');
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);


Route::resource('categories', CategoryController::class);

// Product Routes (This automatically generates all CRUD routes)
Route::resource('products', ProductController::class);

// Welcome Route
Route::get('/', function () {
    return view('welcome');
});