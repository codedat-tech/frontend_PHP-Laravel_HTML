<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TestMailController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BlueprintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewOrderController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DesignerBookingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewConsultationController;
use App\Http\Controllers\GalleryController;

//"/" se redirect ve login
Route::get('/', [AuthController::class, 'login'])->name('login');

/*
|--------------------------------------------------------------------------
// Hoang routes
|--------------------------------------------------------------------------
*/
// User Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('user.userpage');
})->name('user.userpage');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
// Designer Routes
Route::get('/login_designer', [AuthController::class, 'login_designer'])->name('login_designer');
Route::post('/login_designer', [AuthController::class, 'loginPost_designer'])->name('login.post_designer');
Route::get('/designerpage', function () {
    return view('designer.designerpage');
})->name('designer.designerpage');
Route::get('/register_designer', [AuthController::class, 'register_designer'])->name('register_designer');
Route::post('/register_designer', [AuthController::class, 'registerPost_designer'])->name('registerPost_designer');
// Admin Routes
Route::get('/login_admin', [AuthController::class, 'login_admin'])->name('login_admin');
Route::post('/login_admin', [AuthController::class, 'loginPost_admin'])->name('login.post_admin');
//= Routes
//Booking Routes
Route::get('/designer-booking', [DesignerBookingController::class, 'index'])->name('customer.designer_booking');
Route::get('/booking-history', [DesignerBookingController::class, 'bookingHistory'])->name('customer.booking_history');
Route::get('/booking/{id}', [DesignerBookingController::class, 'show'])->name('booking.details');
Route::get('/designer-booking/{id}', [DesignerBookingController::class, 'showBookingForm'])->name('booking_form');
Route::post('/booking', [DesignerBookingController::class, 'store'])->name('booking.store'); // Đặt lịch
Route::delete('/booking/{id}/cancel', [DesignerBookingController::class, 'cancel'])->name('booking.cancel');
Route::get('/designer/bookings/{id}', [DesignerController::class, 'bookingDetails'])->name('designer.booking.details');
Route::post('/designer/bookings/{id}/action', [DesignerController::class, 'bookingAction'])->name('designer.booking.action');
Route::get('/designer/bookings', [DesignerController::class, 'bookings'])->name('designer.bookings');
Route::get('/booking/{id}', [DesignerController::class, 'bookingDetails'])->name('ds_booking.details');
//--------------------------------------------------------------------------------------------------------------------------

/*
|--------------------------------------------------------------------------
// Nhan routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name(name: 'dashboard');
// Brand Routes
Route::resource('brands', BrandController::class);
// Category Routes
Route::resource('categories', CategoryController::class);
//designer routes
Route::resource('designers', DesignerController::class);
//review orders
Route::resource('review_orders', ReviewOrderController::class);
// Customers
Route::resource('customers', CustomerController::class);

// Test Mail
Route::get('/test-email', [TestMailController::class, 'sendTestEmail']);
//orders
Route::resource('orders', OrderController::class);
//consulations
Route::resource('consultations', ConsultationController::class);
//--------------------------------------------------------------------------------------------------------------------------
/*
|--------------------------------------------------------------------------
// subadmin routes----------------------------------------------------------------
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    //products
    Route::get('/products/view', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{productID}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{productID}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{productID}', [ProductController::class, 'destroy'])->name('products.destroy');


    // Blueprints
    Route::get('/blueprints/view', [BlueprintController::class, 'index'])->name('blueprints.index');
    Route::get('/blueprints/create', [BlueprintController::class, 'create'])->name('blueprints.create');
    Route::post('/blueprints/store', [BlueprintController::class, 'store'])->name('blueprints.store');
    Route::get('/blueprints/edit/{blueprintID}', [BlueprintController::class, 'edit'])->name('blueprints.edit');
    Route::put('/blueprints/update/{blueprintID}', [BlueprintController::class, 'update'])->name('blueprints.update'); // Changed to PUT
    Route::delete('/blueprints/delete/{blueprintID}', [BlueprintController::class, 'destroy'])->name('blueprints.delete');



    Route::post('/category-design/store', [BlueprintController::class, 'storeCategoryDesign'])->name('category-design.store'); // Store new category design

    // Brand Routes
    Route::resource('brands', BrandController::class);
    // Category Routes
    Route::resource('categories', CategoryController::class);
    //designer routes
    Route::resource('designers', DesignerController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('consultations', ConsultationController::class);
    //review orders
    Route::resource('review_orders', ReviewOrderController::class);
    // Customers
    Route::resource('customers', CustomerController::class);
    //dashboard  report
    Route::prefix('/report')->group(function () {
        Route::get('/products', [ReportController::class, 'index'])->name('reports.products');
        Route::get('/orders', [ReportController::class, 'order'])->name('reports.order');
        Route::get('/cusdesign', [ReportController::class, 'customerDesignerChart'])->name('reports.cusdesign');
        Route::get('/consultations', [ReportController::class, 'consultationsChart'])->name('reports.consultations');
    });
});
//front end
// Route for the root URL
Route::get('/', function () {
    return view('home');
})->name('home');

// Route for /home
Route::get('/home', function () {
    return view('home');
})->name('home');
//design page
// Route for /home
Route::get('/design', function () {
    return view('design');
})->name('design');

// Route to show the designer page
Route::get('/designer', [DesignerController::class, 'showDesigners'])->name('designer.show');

// Route to list all designers

//front end product
Route::get('/product', function () {
    return view('product'); // Assuming your Blade view is named product.blade.php
});
Route::get('/product', [ProductController::class, 'show'])->name('product.show');
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
//checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');





Route::get('/review', function () {
    return view('review'); // Assuming your Blade view is named product.blade.php
});
Route::post('/reviews', [ReviewConsultationController::class, 'store']);

//interior-design
Route::get('/interior-design', [GalleryController::class, 'index']);
