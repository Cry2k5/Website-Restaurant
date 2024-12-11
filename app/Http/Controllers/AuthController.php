<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Show the login form
    public function create()
    {
        // Redirect to dashboard if the user is already logged in
        if (Auth::check()) {
            return redirect()->route('users.index');
        }

        return view('auth.login');
    }

    // Handle the login process
    public function login(AuthRequest $request)
    {
        // Get credentials from the request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){

            return redirect()->route('orders.view');
        }

        // If login fails, return with an error
        return redirect()->route('auth.form-login')->with('error', 'Email hoặc Mật khẩu không chính xác!');
    }

    // Handle user logout
    public function logout(Request $request)
    {
        // Logout and invalidate the session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.form-login');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Send OTP to the user's email for password recovery
    public function sendOtp(Request $request)
    {
        // Validate the email address
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
        ]);


        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            // Generate OTP and store it in the session
            $otp = rand(100000, 999999);
            Session::put('otp', $otp);
            Session::put('otp_expires_at', now()->addMinutes(5)); // OTP expires after 5 minutes
            Session::put('email', $email);

            // Send OTP to the user's email
            Mail::raw("Mã OTP của bạn là: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Mã OTP xác thực');
            });

            return redirect()->route('otp.form');
        } else {
            return redirect()->route('auth.form-forgot');
        }
    }

    // Show OTP form for verification
    public function showOtpForm()
    {
        if (!Session::has('otp')) {
            return redirect()->route('auth.form-forgot')->withErrors(['email' => 'Vui lòng nhập email nhận mã OTP!!']);
        }

        return view('auth.otp');
    }

    // Verify the OTP entered by the user
    public function verifyOtp(Request $request)
    {
        $inputOtp = $request->input('otp');
        $storedOtp = Session::get('otp');
        $expiresAt = Session::get('otp_expires_at');

        // Check if OTP is valid and hasn't expired
        if (!$storedOtp || now()->greaterThan($expiresAt)) {
            Session::forget(['otp', 'otp_expires_at', 'email']);
            return back()->withErrors(['otp' => 'Mã OTP đã hết hạn. Vui lòng thử lại.']);
        }

        if ($inputOtp == $storedOtp) {
            return redirect()->route('auth.reset')->with('success', 'Xác nhận OTP thành công!');
        } else {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ.']);
        }
    }

    // Show the change password form
    public function showChangePasswordForm()
    {
        // Check if the OTP session exists, if not redirect to the forgot password page
        if (!Session::has('otp')) {
            return redirect()->route('auth.form-forgot')->withErrors(['email' => 'Vui lòng nhập email để nhận mã OTP trước.']);
        }

        return view('auth.change-password');
    }

    // Change the user's password after OTP verification
    public function changePassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'new_password' => 'required|confirmed|min:6',
        ], [
            'new_password.required' => 'Mật khẩu mới là bắt buộc.',
            'new_password.min' => 'Mật khẩu mới phải chứa ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        // Get the token from the request
        $token = $request->input('token');

        // Ensure the session token is valid
        if ($token !== Session::get('otp_token')) {
            return redirect()->route('auth.form-forgot')->withErrors(['token' => 'OTP không đúng.']);
        }

        // Retrieve the email from the session and find the user
        $email = Session::get('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('auth.form-forgot')->withErrors(['email' => 'Không tìm thấy người dùng với email này.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Clear session data related to OTP
        Session::forget(['otp', 'otp_expires_at', 'email', 'otp_token']);

        return redirect()->route('auth.form-login')->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }
}
