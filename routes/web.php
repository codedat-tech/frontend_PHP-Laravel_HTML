<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BlueprintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewOrderController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DesignerBookingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ReviewConsultationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BlogViewController;

// // Brand Routes
Route::resource('brands', BrandController::class);

// // Category Routes
Route::resource('categories', CategoryController::class);
// //designer routes

// //review orders
// Route::resource('review_orders', ReviewOrderController::class);
// // Customers
// Route::resource('customers', CustomerController::class);

// //orders
// Route::resource('orders', OrderController::class);
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
    Route::post('/products/toggle-status/{productID}', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
    // check duplicate product name
    Route::post('/products/check-product-name', [ProductController::class, 'checkName'])->name('products.checkName');
    // check dulicate image name
    Route::post('/products/check-image-name', [ProductController::class, 'checkImageName'])->name('products.checkImageName');

    //consultation
    Route::resource('consultations', ConsultationController::class);
    Route::get('consultations/sendMail/{consultationID}', [ConsultationController::class, 'sendMail'])->name('consultations.sendMail');
    Route::post('consultations/toggle-status/{consultationID}', [ConsultationController::class, 'toggleStatus'])->name('consultations.toggleStatus');

    // Blueprints
    // Route::resource('blueprints', BlueprintController::class);
    Route::get('/blueprints/view', [BlueprintController::class, 'index'])->name('blueprints.index');
    Route::get('/blueprints/create', [BlueprintController::class, 'create'])->name('blueprints.create');
    Route::post('/blueprints/store', [BlueprintController::class, 'store'])->name('blueprints.store');
    Route::put('/blueprints/update/{blueprintID}', [BlueprintController::class, 'update'])->name('blueprints.update');
    Route::get('/blueprints/{blueprintID}/edit', [BlueprintController::class, 'edit'])->name('blueprints.edit');
    Route::post('/blueprints/checkBlueprintName', [BlueprintController::class, 'checkName'])->name('blueprints.checkName');


    Route::put('/blueprints/update/{blueprintID}', [BlueprintController::class, 'update'])->name('blueprints.update');
    Route::post('/blueprints/toggle-status/{blueprintID}', [BlueprintController::class, 'toggleStatus'])->name('blueprints.toggleStatus');
    Route::post('/category-design/store', [BlueprintController::class, 'storeCategoryDesign'])->name('category-design.store');

    // Brand Routes
    Route::resource('brands', BrandController::class);
    Route::post('/checkBrandName', [BrandController::class, 'checkBrandName'])->name('brands.checkBrandName');
    Route::post('/brands/toggle-status/{brandID}', [BrandController::class, 'toggleStatus'])->name('brands.toggleStatus');


    // Category Routes
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/checkCategoryName', [CategoryController::class, 'checkCategoryName'])->name('categories.checkCategoryName');
    Route::post('categories/toggle-status/{categoryID}', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

    //designer routes
    Route::resource('designers', DesignerController::class);
    Route::put('designers/edit.{designerID}', [DesignerController::class, 'update']);
    Route::post('designers/toggle-status/{designerID}', [DesignerController::class, 'toggleStatus'])->name('designers.toggleStatus');

    // Orders
    Route::resource('orders', OrderController::class);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/toggle-status/{orderID}', [OrderController::class, 'toggleStatus'])->name('orders.toggleStatus');
    Route::get('/order/{order}/download-pdf', [OrderController::class, 'downloadPDF'])->name('orders.downloadPDF');
    Route::post('/orders/{orderID}/status', [OrderController::class, 'updateOrderStatus']);
    // send order email
    Route::get('sendOrderMail/{orderID}', [MailController::class, 'sendOrderMail'])->name('orders.sendMail');

    // Route::get('/order-detail/{id}', 'OrderController@show')->name('order.detail');
    // Route::resource('ordersDetail', OrderDetailController::class); eeeeeeeeeee

    //review orders
    Route::resource('review_orders', ReviewOrderController::class);

    // Customers
    Route::resource('customers', CustomerController::class);
    Route::post('customers/toggle-status/{customerID}', [CustomerController::class, 'toggleStatus'])->name('customers.toggleStatus');

    //dashboard  report
    Route::prefix('/report')->group(function () {
        Route::get('/products', [ReportController::class, 'index'])->name('reports.products');
        Route::get('/orders', [ReportController::class, 'order'])->name('reports.order');
        Route::get('/cusdesign', [ReportController::class, 'customerDesignerChart'])->name('reports.cusdesign');
        Route::get('/consultations', [ReportController::class, 'consultationsChart'])->name('reports.consultations');
    });

    // blog
    Route::resource('blogs', BlogController::class);
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//front end

// home
Route::get('/', [DesignerController::class, 'showIndex'])->name('index');

// Route::get('/login/login', function () {
//     return view('login'); 
// })->name('login');

// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

// Route for register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');


// Forget password
Route::get('/login/password/forget', [AuthController::class, 'showForgetPasswordForm'])->name('password.forget');
Route::post('/login/password/email', [AuthController::class, 'submitForgetPasswordForm'])->name('password.email');

// Reset password
Route::get('/login/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/login/password/reset', [AuthController::class, 'submitResetPasswordForm'])->name('password.update');



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route to show the designer page
Route::resource('designers', DesignerController::class);
Route::get('/designer', [DesignerController::class, 'showDesigners'])->name('designer.show');
Route::get('/consultations/schedule', [ConsultationController::class, 'showSchedule']);

Route::get('/index', [DesignerController::class, 'showIndex'])->name('index');
// Route::get('/index', [DesignerController::class, 'showIndex'])->name('designer.index');

// Route::resource('consultations', ConsultationController::class);
// consultation
Route::get('/consultations/view', [ConsultationController::class, 'index'])->name('consultation.index');
Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultations/store', [ConsultationController::class, 'store'])->name('consultation.store');
Route::get('/consultations/edit/{consultationID}', [ConsultationController::class, 'edit'])->name('consultation.edit');
Route::put('/consultations/update/{consultationID}', [ConsultationController::class, 'update'])->name('consultation.update');

Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultation.addSchedule');
Route::post('/consultations/check-schedule', [ConsultationController::class, 'checkScheduleAvailability'])->name(('consultation.checkSchedule'));
Route::post('/consultations/store', [ConsultationController::class, 'checkScheduleAvailability'])->name(('consultation.checkSchedule'));
Route::post('/check-schedule-conflict', [ConsultationController::class, 'checkScheduleConflict']);
Route::get('/bad-words', function () {
    return response()->json(file(storage_path('app/bad_words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
});

//front end product
Route::get('/product', function () {
    return view('product');
});
Route::get('/product', [ProductController::class, 'show'])->name('product.show');
// // Cart Routes

//cart
Route::get('/cart', [FrontendController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [FrontendController::class, 'addCart'])->name('cart.add');
Route::get('/cart/delete/{productID}', [FrontendController::class, 'deleteCart']);
Route::post('/cart/update/{id}', [FrontendController::class, 'updateQuantity']);


//checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


Route::get('/review', function () {
    return view('review');
});
Route::post('/reviews', [ReviewConsultationController::class, 'store']);

//interior-design
Route::get('/interior-design', [GalleryController::class, 'index'])->name('interior-design');


//delivery
Route::get('/delivery', [FrontendController::class, 'showDeliveryPage'])->name('delivery');
// Route::get('/delivery', function () {
//     return view('delivery');
// });


//order
// Route for submitting the order
Route::post('/submit-order', [FrontendController::class, 'submitOrder'])->name('submit.order');

// Route for showing the order confirmation
Route::get('/order_confirmation/{id}', [FrontendController::class, 'orderConfirmation'])->name('order.confirmation');

Route::get('/order/{orderId}', [FrontendController::class, 'show'])->name('order.show');

// In your web.php (routes file)
Route::get('/send-test-email', function () {
    Mail::raw('This is a test email from Mailtrap!', function ($message) {
        $message->to('duongnhi0613@gmail.com') // Change to a valid email address
            ->subject('Test Email');
    });

    return 'Test email sent!';
});

//blog
// Route::get('/blog', function () {
//     return view('/blog/blog');
// });
Route::get('/blog', [BlogViewController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogViewController::class, 'show'])->name('blog.show');


//product
Route::get('/product_detail/{productID}', [FrontendController::class, 'showProductDetail'])->name('product.detail');




// Route::get('/layouts.header', [HeaderController::class, 'index'])->name('layouts.header');
Route::get('/header', [HeaderController::class, 'showMenu'])->name('header.showMenu');

//category
Route::get('/category', function () {
    return view('category');
});
Route::get('/category/{categoryID}', [FrontendController::class, 'showCategory'])->name('category.show');
Route::get('/category/{categoryID}/{productID}', [FrontendController::class, 'showProduct'])->name('product.view');
Route::get('/search-products', [FrontendController::class, 'searchProducts'])->name('search.products');

Route::get('/product/{productID}', [FrontendController::class, 'showProduct'])->name('product.show');


// Route::get('/test-email', function () {
//     Mail::raw('This is a test email!', function ($message) {
//         $message->to('congtu7677@gmail.com')
//             ->subject('Test Email');
//     });

//     return 'Email sent!';
// });
// voucher
Route::resource('vouchers', VoucherController::class);
Route::post('vouchers/{id}/toggle-status', [VoucherController::class, 'toggleStatus'])->name('vouchers.toggleStatus');
Route::get('vouchers/check-code', [VoucherController::class, 'checkCode'])->name('vouchers.checkCode');

// profile edit
Route::get('/profile/{id}', [DesignerController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update', [DesignerController::class, 'updateProfile'])->name('profile.update');

//Route hiển thị danh sach cac bài blog
Route::get('blogs', [FrontendBlogController::class, 'index'])->name('frontend.blogs.index');
//Route hiển thi chi tiết 1 bài blog
Route::get('blogs/{id}', [FrontendBlogController::class, 'show'])->name('frontend.blogs.show');


//payment
use App\Http\Controllers\PayPalController;

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');
Route::get('payment/cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');


//order-confirm

// Route for viewing order history
// Route::get('/order-history', [FrontendController::class, 'showOrderHistory'])->name('order.history');
Route::get('/order-details/{orderID}', [FrontendController::class, 'showOrderDetails'])->name('order.details');


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
