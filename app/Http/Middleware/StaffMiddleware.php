<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
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
        if(!(Auth::check())){
            return redirect('/')->with('error', 'You must login first!!');

        }

        if (Auth::user()->role == 'Staff' || Auth::user()->role == 'Admin') {
                return $next($request);
        }


        // Nếu không phải 'staff' hoặc 'admin', chuyển hướng người dùng về trang chủ hoặc trang khác
        return redirect('/')->with('error', '!!!!');
    }
}
