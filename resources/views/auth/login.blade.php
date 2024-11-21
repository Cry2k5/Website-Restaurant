
<x-base-layout title="Administrator Login">
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
    </style>
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
            <a href="{{ route('password.request') }}" class="text-danger">Quên mật khẩu?</a>
        </div>
    </form>
</div>
</x-base-layout>
