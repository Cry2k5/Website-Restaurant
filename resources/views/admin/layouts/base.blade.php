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
    </style>
</head>
<body>
{{$slot}}
<script>
    // Lắng nghe sự kiện "Edit" để điền thông tin vào modal
    // document.querySelectorAll('.edit-btn').forEach(function (button) {
    //     button.addEventListener('click', function () {
    //         var userId = this.getAttribute('data-id');
    //         // Lấy thông tin người dùng từ bảng hoặc API nếu cần
    //         var userName = this.getAttribute('data-name');
    //         var userEmail = this.getAttribute('data-email');
    //         // Cập nhật giá trị các trường trong modal
    //         document.getElementById('userNameEdit').value = userName;
    //         document.getElementById('userEmailEdit').value = userEmail;
    //         document.getElementById('userIdEdit').value = userId;
    //     });
    // });
    document.querySelectorAll('.edit-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var userId = this.getAttribute('data-id'); // Lấy ID người dùng

            // Gửi AJAX request đến controller để lấy thông tin người dùng
            $.ajax({
                url: '/users/' + userId + '/edit',  // Đường dẫn lấy thông tin người dùng
                method: 'GET',
                success: function(data) {
                    // Điền dữ liệu vào modal form
                    $('#userNameEdit').val(data.name);
                    $('#userEmailEdit').val(data.email);
                    $('#userPhoneEdit').val(data.phone);
                    $('#userAddressEdit').val(data.address);
                    $('#userRoleEdit').val(data.role);
                    $('#userIdEdit').val(data.id); // Điền ID vào hidden field
                }
            });
        });
    });


</script>
</body>
</html>
