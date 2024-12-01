<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home.index');
Route::get('/menu',[HomeController::class,'menu'])->name('home.menu');
Route::get('/gallery',[HomeController::class,'gallery'])->name('home.gallery');
Route::get('/about',[HomeController::class,'about'])->name('home.about');
Route::get('/blog',[HomeController::class,'blog'])->name('home.blog');
Route::get('/contact',[HomeController::class,'contact'])->name('home.contact');

Route::get('/reservation',[ReservationController::class,'reservation'])->name('home.reservation');
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('home.reservations.store');


//Admin logic login
Route::get('/admin', [AuthController::class, 'create'])->name('auth.form-login')->middleware(LoginMiddleware::class);
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('auth.form-forgot');
Route::post('/admin/forgot-password', [AuthController::class, 'sendOtp'])->name('auth.send-otp');

Route::get('/admin/otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/admin/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/admin/change-password', [AuthController::class, 'showChangePasswordForm'])->name('auth.reset');
Route::post('/admin/change-password', [AuthController::class, 'changePassword'])->name('auth.submit-change');

//Administration Page
Route::get('/admin/home', function () {
    return view('admin.home'); // Trả về view 'welcome'
});



Route::get('/admin/users', [UserController::class,'index'])->name('users.index');

Route::get('/admin/users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/admin/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/admin/users/search', [UserController::class, 'search'])->name('users.search');
Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/admin/blogs', [BlogController::class,'index'])->name('blogs.index');

Route::get('/admin/blogs/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/admin/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/admin/blogs/store', [BlogController::class, 'store'])->name('blogs.store');

Route::get('/admin/blogs/search', [BlogController::class, 'search'])->name('blogs.search');
Route::delete('/admin/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::get('/admin/tables', [TableController::class,'index'])->name('tables.index');

Route::get('/admin/tables/{table_id}', [TableController::class, 'edit'])->name('tables.edit');
Route::put('/admin/tables/{table_id}', [TableController::class, 'update'])->name('tables.update');

Route::get('/admin/tables/create', [TableController::class, 'create'])->name('tables.create');
Route::post('/admin/tables/store', [TableController::class, 'store'])->name('tables.store');

Route::get('/admin/tables/search', [TableController::class, 'search'])->name('tables.search');
Route::delete('/admin/tables/{table_id}', [TableController::class, 'destroy'])->name('tables.destroy');


Route::get('/admin/dishes', [DishController::class,'index'])->name('dishes.index');

Route::get('/admin/dishes/{dish_id}', [DishController::class, 'edit'])->name('dishes.edit');
Route::put('/admin/dishes/{dish_id}', [DishController::class, 'update'])->name('dishes.update');

Route::get('/admin/dishes/create', [DishController::class, 'create'])->name('dishes.create');
Route::post('/admin/dishes/store', [DishController::class, 'store'])->name('dishes.store');

Route::get('/admin/dishes/search', [DishController::class, 'search'])->name('dishes.search');
Route::delete('/admin/dishes/{dish_id}', [DishController::class, 'destroy'])->name('dishes.destroy');


Route::get('/admin/bills', [BillController::class,'index'])->name('bills.index');
Route::delete('/admin/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');

// Định nghĩa nhóm route cho admin/orders
Route::prefix('admin')->group(function () {
    // Route liên quan đến quản lý đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/add', [OrderController::class, 'addToCart'])->name('orders.add');
    Route::post('/orders/update', [OrderController::class, 'updateCart'])->name('orders.update');
    Route::post('/orders/remove', [OrderController::class, 'removeFromCart'])->name('orders.remove');

    Route::get('/orders/checkout', [OrderController::class, 'showCheckout'])->name('orders.showCheckout');
    Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');

    // Route dành riêng cho POS (Point of Sale)
    Route::get('/pos', [OrderController::class, 'posIndex'])->name('orders.view');
    Route::get('/orders/print/{bill_id}', [OrderController::class, 'printInvoice'])->name('orders.print');

});
