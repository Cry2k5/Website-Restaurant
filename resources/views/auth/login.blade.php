
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Dăng nhập</title>
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
    <h2 class="text-center mb-4">Đăng Nhập</h2>
{{--    //lấy ra tất cả lỗi--}}
{{--    @if($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control bg-dark text-light" id="email" name="email" >
            @if($errors->has('email'))
                <span class="error-message">
                    *{{$errors->first('email')}}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control bg-dark text-light" id="password" name="password" >
            @if($errors->has('password'))
                <span class="error-message">
                    *{{$errors->first('password')}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-custom w-100">Đăng Nhập</button>
        <div class="text-center mt-3">
            <a href="{{ route('auth.form-forgot') }}" class="text-danger">Quên mật khẩu?</a>
        </div>
    </form>
</div>
<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Optionally, add Bootstrap JS if you need it -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
