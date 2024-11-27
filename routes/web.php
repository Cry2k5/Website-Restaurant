<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

Route::get('/',[HomeController::class,'home'])->name('home.index');
Route::get('/menu',[MenuController::class,'menu'])->name('home.menu');
Route::get('/gallery',[GalleryController::class,'gallery'])->name('home.gallery');
Route::get('/about',[HomeController::class,'about'])->name('home.about');
Route::get('/blog',[BlogController::class,'index'])->name('home.blog');
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

Route::get('admin/change-password', [AuthController::class, 'showChangePasswordForm'])->name('auth.reset');
Route::post('admin/change-password', [AuthController::class, 'changePassword'])->name('auth.submit-change');

//Administration Page
Route::get('/admin/home', function () {
    return view('admin.home'); // Trả về view 'welcome'
});



Route::resource('admin/users', UserController::class);
Route::get('users/{user}/edit', [UserController::class, 'edit']);
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
