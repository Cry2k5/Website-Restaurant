<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StaffMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


// Các route cho frontend
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/menu', [HomeController::class, 'menu'])->name('home.menu');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('home.gallery');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/reservation', [ReservationController::class, 'reservation'])->name('home.reservation');
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('home.reservations.store');

// Các route cho đăng nhập và đăng xuất Admin
Route::get('/admin', [AuthController::class, 'create'])->name('auth.form-login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Các route liên quan đến thay đổi mật khẩu, quên mật khẩu
Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('auth.form-forgot');
Route::post('/admin/forgot-password', [AuthController::class, 'sendOtp'])->name('auth.send-otp');
Route::get('/admin/otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/admin/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/admin/change-password', [AuthController::class, 'showChangePasswordForm'])->name('auth.reset');
Route::post('/admin/change-password', [AuthController::class, 'changePassword'])->name('auth.submit-change');

//dành cho Staff
Route::prefix('admin')->middleware(StaffMiddleware::class)->group(function () {
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/add', [OrderController::class, 'addToCart'])->name('orders.add');
    Route::post('/orders/update', [OrderController::class, 'updateCart'])->name('orders.update');
    Route::post('/orders/remove', [OrderController::class, 'removeFromCart'])->name('orders.remove');
    Route::get('/orders/checkout', [OrderController::class, 'showCheckout'])->name('orders.showCheckout');
    Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/vnpay-return', [OrderController::class, 'vnpayReturn'])->name('orders.vnpay_return');

    Route::get('/orders/print/{bill_id}', [OrderController::class, 'printInvoice'])->name('orders.print');
    Route::get('/pos', [OrderController::class, 'posIndex'])->name('orders.view');


    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::get('/tables/{table_id}', [TableController::class, 'edit'])->name('tables.edit');
    Route::put('/tables/{table_id}', [TableController::class, 'update'])->name('tables.update');
    Route::get('/tables/create', [TableController::class, 'create'])->name('tables.create');
    Route::post('/tables/store', [TableController::class, 'store'])->name('tables.store');
    Route::get('/tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::delete('/tables/{table_id}', [TableController::class, 'destroy'])->name('tables.destroy');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    Route::get('/dishes', [DishController::class, 'index'])->name('dishes.index');
    Route::get('/dishes/{dish_id}', [DishController::class, 'edit'])->name('dishes.edit');
    Route::put('/dishes/{dish_id}', [DishController::class, 'update'])->name('dishes.update');
    Route::get('/dishes/create', [DishController::class, 'create'])->name('dishes.create');
    Route::post('/dishes/store', [DishController::class, 'store'])->name('dishes.store');
    Route::delete('/dishes/{dish_id}', [DishController::class, 'destroy'])->name('dishes.destroy');

    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/{gallery}', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries/store', [GalleryController::class, 'store'])->name('galleries.store');
    Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});

// Các route chỉ dành cho admin
Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {

    // Các route liên quan đến người dùng
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
//    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Các route liên quan đến các phần còn lại của hệ thống
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
    // Route::post('/vnpay_paymant', [OrderController::class, 'checkout'])->name('orders.checkout');
