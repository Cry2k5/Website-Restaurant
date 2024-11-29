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
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }
        .sidebar li {
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s;
        }
        .sidebar li:hover {
            background-color: #495057;
        }
        .sidebar li.active {
            background-color: #007bff;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }
        .pagination {
            justify-content: center; /* Căn giữa phân trang */
            margin-top: 20px; /* Khoảng cách từ bảng lên phân trang */
        }

        .pagination .page-item {
            margin: 0 5px; /* Khoảng cách giữa các trang */
        }

        .pagination .page-link {
            color: #007bff; /* Màu sắc mặc định của liên kết */
            border: 1px solid #dee2e6; /* Viền của các trang */
            padding: 8px 15px; /* Khoảng cách bên trong mỗi trang */
            border-radius: 5px; /* Bo góc nhẹ cho các trang */
            transition: background-color 0.3s, color 0.3s; /* Hiệu ứng hover */
        }

        .pagination .page-link:hover {
            background-color: #007bff; /* Màu nền khi hover */
            color: white; /* Màu chữ khi hover */
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff; /* Màu nền cho trang đang chọn */
            color: white; /* Màu chữ cho trang đang chọn */
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d; /* Màu cho các trang không có hiệu lực (ví dụ: "Previous" và "Next" khi ở trang đầu/cuối) */
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
