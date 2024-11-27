<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Đổi Mật Khẩu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #1b1b1b, #2c2c2c);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .form-container {
            background-color: #111;
            border-radius: 8px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        .btn-custom {
            background: linear-gradient(to right, #28a745, #218838);
            border: none;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center mb-4">Đổi Mật Khẩu</h2>

{{--    <!-- Hiển thị thông báo thành công nếu có -->--}}
{{--    @if(session('status'))--}}
{{--        <div class="alert alert-success">{{ session('status') }}</div>--}}
{{--    @endif--}}

{{--    <!-- Hiển thị thông báo lỗi nếu có -->--}}
{{--    @if($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    <!-- Form đổi mật khẩu -->
    <form action="{{ route('auth.submit-change') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ session('otp_token') }}"> <!-- Đảm bảo token được gửi trong form -->
        <div class="mb-3">
            <label for="new_password" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control bg-dark text-light" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control bg-dark text-light" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Cập Nhật Mật Khẩu</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Optionally, add Bootstrap JS if you need it -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
