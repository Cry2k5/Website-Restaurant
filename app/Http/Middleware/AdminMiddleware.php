<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect('/')->with('error', 'You must login first!');
        }

        // Kiểm tra nếu người dùng có vai trò 'Admin'
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('orders.view')->with('error', 'You do not have permission to access this page!');
        }

        // Cho phép truy cập tiếp nếu người dùng là Admin
        return $next($request);
    }
}

