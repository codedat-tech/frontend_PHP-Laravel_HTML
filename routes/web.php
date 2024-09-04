<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login');

// Define route for index view
Route::get('index', function () {
    return view('index');
})->name('index');

Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

