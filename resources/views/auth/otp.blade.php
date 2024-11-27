<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Nhập OTP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #1b1b1b, #2c2c2c);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background-color: #111;
            border-radius: 8px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            color: #fff;
        }
        .btn-custom {
            background: linear-gradient(to right, #ff3c3c, #ff0000);
            border: none;
        }
        .error-message{
            color:red;
            font-size: 12px;
            margin-top: 5px;
            font-style: italic;
        }

    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center mb-4">Nhập OTP</h2>
    <p class="text-center mb-3">Vui lòng kiểm tra email để nhận mã OTP</p>
{{--    //lấy ra tất cả lỗi--}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ session('otp_token') }}">
        <!-- Input OTP -->
        <div class="mb-3">
            <label for="otp" class="form-label">Mã OTP:</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Xác nhận OTP</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Optionally, add Bootstrap JS if you need it -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
