<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu - Nhập Email</title>
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
    <h2 class="text-center mb-4">Quên Mật Khẩu</h2>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Nhập email của bạn:</label>
            <input type="email" class="form-control bg-dark text-light" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Gửi mail</button>
    </form>
</div>
</body>
</html>
