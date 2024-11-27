<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn đặt bàn</title>
    <!-- Thêm liên kết tới Bootstrap CSS -->

</head>
<body>
<div class="container">
    <h1>Thank you for your reservation!</h1>
    <h2>Here are the details of your reservation:</h2>
    <div>
        <div>
            <p><strong>Name:</strong> {{ $reservation->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $reservation->customer_phone }}</p>
            <p><strong>Email:</strong> {{ $reservation->customer_email }}</p>
            <p><strong>Table ID:</strong> {{ $reservation->table_id }}</p>
            <p><strong>Date:</strong> {{ $reservation->reservation_date }}</p>
            <p><strong>Time:</strong> {{ $reservation->reservation_time }}</p>
            <p class="details"><strong>Description:</strong> {{ $reservation->description }}</p>
        </div>
    </div>
</div>

<!-- Thêm liên kết tới Bootstrap JS và Popper.js để hỗ trợ các thành phần như modal, dropdown, v.v -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
