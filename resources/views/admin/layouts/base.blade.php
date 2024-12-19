@props(['title'=>''])
    <!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{$title}} | Administration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>body {
    display: flex;
    height: 100vh;
    margin: 0;
}

.sidebar {
    position: fixed; /* Đặt sidebar ở vị trí cố định */
    top: 0; /* Đảm bảo nó bắt đầu từ trên cùng */
    left: 0; /* Đảm bảo nó dính vào bên trái */
    width: 250px; /* Kích thước sidebar */
    height: 100vh; /* Chiều cao toàn màn hình */
    background-color: #343a40;
    color: white;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Đảm bảo sidebar luôn hiển thị phía trên các phần tử khác */
    overflow-y: auto; /* Cho phép cuộn khi nội dung bên trong vượt quá chiều cao */
}

.sidebar ul {
    list-style: none;
    padding: 0;
    width: 100%;
}

.sidebar li {
    padding: 15px;
    text-align: left;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    border-bottom: 1px solid #495057;
    padding-left: 20px;
}

.sidebar li:hover {
    background-color: #495057;
    transform: scale(1.05);
}

.sidebar li.active {
    background-color: #007bff;
}

.sidebar li.active:hover {
    background-color: #0056b3;
}

.sidebar li:last-child {
    border-bottom: none;
}

.sidebar .logo {
    text-align: center;
    margin-bottom: 30px;
    font-size: 24px;
    font-weight: bold;
    color: #ffffff;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    background: #f8f9fa;
    margin-left: 250px; /* Dành không gian cho sidebar */
}

.pagination {
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-link {
    color: #007bff;
    border: 1px solid #dee2e6;
    padding: 8px 15px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    cursor: not-allowed;
}

.pagination .page-item:first-child .page-link {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.pagination .page-item:last-child .page-link {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}


    </style>
</head>
<body>
<x-admin-side-bar />
{{$slot}}
</body>
</html>
