<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


// Admin Login Routes
Route::get('admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login');


Route::get('index', [ProductController::class, 'index'])->name('index');
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);


Route::resource('categories', CategoryController::class);

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/welcome', [AdminController::class, 'showWelcomePage'])->name('admin.welcome');

// Product Routes (This automatically generates all CRUD routes)
Route::resource('products', ProductController::class);

Route::get('/welcome',[HomeController:: class,'index'])->Middleware('admin');
// Route::get('/index',[HomeController:: class,'index'])->Middleware('admin');


// Route::get('/index', function () {
//     return view('index');
// })->name('index');
// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

// Welcome Route
Route::get('/', function () {
    return view('admin');
});