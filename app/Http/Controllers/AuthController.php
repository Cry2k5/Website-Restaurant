<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function create()
    {
//        dd(Auth::id());
//        if(Auth::id()>0)
//        {
//            return redirect()->route('admin.dashboard');
//        }
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(AuthRequest $request)
    {
        $credentials=[
            'email' => $request->input("email"),
            'password' => $request->input("password")
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success','Đăng nhập thành công!');

        }

        return redirect()->route('auth.form-login')->with('error','Email hoặc Mật khẩu không chính xác!');

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.form-login');

    }

    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Gửi OTP tới email
    public function sendOtp(Request $request)
    {
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);

        // Giả lập gửi email OTP
        Mail::raw("Mã OTP của bạn là: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Mã OTP xác thực');
        });

        return redirect()->route('otp.form');
    }

    // Hiển thị form nhập OTP
    public function showOtpForm()
    {
        return view('auth.otp');
    }

    // Xác minh OTP
    public function verifyOtp(Request $request)
    {
        $otp = Session::get('otp');
        if ($request->otp == $otp) {
            return "Xác thực OTP thành công!";
        } else {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác']);
        }
    }
}
