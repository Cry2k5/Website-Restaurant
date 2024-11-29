<x-admin-base-layout title="Quản lý món ăn">
    <div class="main-content" style="padding: 20px;">
        <h3>Quản lý món ăn</h3>
        <div class="d-flex justify-content-between my-3">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Tìm món ăn..." onkeyup="searchDishes()">
            <button class="btn btn-success" id="addDishBtn" data-bs-toggle="modal" data-bs-target="#dishModalAdd">Thêm món ăn</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên món ăn</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="dishTableBody">
                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{ $dish->dish_id }}</td>
                        <td>{{ $dish->dish_name }}</td>
                        <td>{{ $dish->category->cate_name ?? 'Chưa phân loại' }}</td>
                        <td>{{ $dish->dish_price }}</td>
                        <td>
                            @if($dish->image)
                                <img src="{{ asset($dish->image) }}" alt="{{ $dish->dish_name }}" width="50">
                            @else
                                Chưa có hình ảnh
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#dishModalEdit" data-id="{{ $dish->dish_id }}">Sửa</button>
                            <form method="POST" action="{{ route('dishes.destroy', $dish->dish_id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $dishes->links() }}
        </div>
    </div>

    <!-- Dish Modal for Add -->
    <div class="modal fade" id="dishModalAdd" tabindex="-1" aria-labelledby="dishModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishModalLabel">Thêm món ăn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Form for Adding Dish -->
                    <form id="dishFormAdd" method="POST" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="dishNameAdd" class="form-label">Tên món ăn</label>
                            <input type="text" class="form-control" id="dishNameAdd" name="dish_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categorySelect" class="form-label">Danh mục</label>
                            <select class="form-select" id="categorySelect" name="cate_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cate_id }}">{{ $category->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dishPriceAdd" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="dishPriceAdd" name="dish_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="dishImageAdd" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="dishImageAdd" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dish Modal for Edit -->
    <div class="modal fade" id="dishModalEdit" tabindex="-1" aria-labelledby="dishModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishModalLabel">Sửa món ăn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="dishFormEdit" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="dishIdEdit" name="dish_id">

                        <div class="mb-3">
                            <label for="dishNameEdit" class="form-label">Tên món ăn</label>
                            <input type="text" class="form-control" id="dishNameEdit" name="dish_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryEdit" class="form-label">Danh mục</label>
                            <select class="form-select" id="categoryEdit" name="cate_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cate_id }}">{{ $category->cate_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dishPriceEdit" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="dishPriceEdit" name="dish_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="dishImageEdit" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="dishImageEdit" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-base-layout>

<script>
    // Tự động điền thông tin vào form chỉnh sửa
    $('.edit-btn').on('click', function() {
        const dishID = $(this).data('id');
        console.log(dishID);
        $.ajax({
            url: '/admin/dishes/' + dishID,
            method: 'GET',
            success: function(dish) {
                // console.log(dish);
                $('#dishIdEdit').val(dish.dish_id);
                $('#dishNameEdit').val(dish.dish_name);
                $('#categoryEdit').val(dish.cate_id);
                $('#dishPriceEdit').val(dish.dish_price);
                // Cập nhật dynamic action của form
                $('#dishFormEdit').attr('action', '/admin/dishes/' + dish.dish_id);
            },
            error: function() {
                alert("Error fetching dish details.");
            }
        });
    });
    // Hàm tìm kiếm món ăn
{{--    function searchDishes() {--}}
{{--        const query = document.getElementById('searchInput').value;--}}
{{--        const url = `/admin/dishes/search?query=${query}`;--}}

{{--        fetch(url)--}}
{{--            .then(response => response.json())--}}
{{--            .then(data => {--}}
{{--                const tableBody = document.getElementById('dishTableBody');--}}
{{--                tableBody.innerHTML = '';--}}
{{--                data.dishes.forEach(dish => {--}}
{{--                    const row = document.createElement('tr');--}}
{{--                    row.innerHTML = `--}}
{{--                        <td>${dish.dish_id}</td>--}}
{{--                        <td>${dish.dish_name}</td>--}}
{{--                        <td>${dish.cate_name}</td>--}}
{{--                        <td>${dish.dish_price}</td>--}}
{{--                        <td><img src="/storage/${dish.image}" width="50"></td>--}}
{{--                        <td>--}}
{{--                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#dishModalEdit" data-id="${dish.dish_id}">Sửa</button>--}}
{{--                            <form method="POST" action="/admin/dishes/${dish.dish_id}" style="display:inline;">--}}
{{--                                @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>--}}
{{--                </form>--}}
{{--            </td>--}}
{{--`;--}}
{{--                    tableBody.appendChild(row);--}}
{{--                });--}}
{{--            });--}}
{{--    }--}}
</script>
