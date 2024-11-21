<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/menu',[HomeController::class,'menu'])->name('menu');
Route::get('/reservation',[HomeController::class,'reservation'])->name('reservation');
Route::get('/gallery',[HomeController::class,'gallery'])->name('gallery');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');


Route::get('/admin', [AuthController::class, 'create'])->name('auth.form-login')
->middleware(LoginMiddleware::class);
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');

Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');

Route::get('/otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');



//Administration Page
Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('admin.dashboard')->middleware(AuthenticateMiddleware::class);

