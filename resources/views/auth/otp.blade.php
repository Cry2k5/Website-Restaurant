<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center mb-4">Nhập OTP</h2>
    <p class="text-center mb-3">Vui lòng kiểm tra email để nhận mã OTP</p>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="otp" class="form-label">Mã OTP:</label>
            <input type="text" class="form-control bg-dark text-light" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Xác Nhận</button>
    </form>
</div>
</body>
</html>
