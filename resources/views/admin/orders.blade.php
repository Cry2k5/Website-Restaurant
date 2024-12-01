@php use Illuminate\Support\Facades\Request; @endphp
<x-admin-base-layout title="Order Page">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Order for Table {{ $restaurant_table->table_id }}</h1>
        <div class="row">
            <!-- Menu -->
            <div class="col-md-6">
                <h2>Menu</h2>
                <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Dish ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dishes as $dish)
                            <tr>
                                <td>{{ $dish->dish_id }}</td>
                                <td>{{ $dish->dish_name }}</td>
                                <td>{{ $dish->category->cate_name }}</td>
                                <td>{{ number_format($dish->dish_price) }} đ</td>
                                <td><input type="number" min="1" value="1" class="quantity form-control"></td>
                                <td>
                                    <button class="btn btn-primary add-to-cart"
                                            data-dish-id="{{ $dish->dish_id }}"
                                            data-price="{{ $dish->dish_price }}">
                                        Add
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cart -->
            <div class="col-md-6">
                <h2>Bill Items</h2>

                @if ($bill && $bill->payment_time)
                    <div class="alert alert-success text-center">
                        <strong>Bill đã được thanh toán vào lúc {{ $bill->payment_time }}</strong>
                    </div>
                @else
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-hover" id="cart-items">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billItems as $item)
                                <tr>
                                    <td>{{ $item->dish->dish_name }}</td>
                                    <td>{{ number_format($item->dish->dish_price) }} đ</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->dish->dish_price * $item->quantity) }} đ</td>
                                    <td>
                                        <button class="btn btn-danger delete-item" data-dish-id="{{ $item->dish_id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display Totals -->
                    <div class="mt-4">
                        <p><strong>Cart Total:</strong> <span id="cart-total">{{ number_format($total) }} đ</span></p>
                        <p><strong>Cart Taxed (10%):</strong> <span id="cart-taxed">{{ number_format($total * 0.10) }} đ</span></p>
                        <p><strong>Grand Total:</strong> <span id="grand-total">{{ number_format($total + $total * 0.10) }} đ</span></p>
                    </div>

                    @if(count($billItems) > 0)
                        <div class="text-center mt-4">
                            <a href="{{ route('orders.showCheckout', ['table_id' => $restaurant_table->table_id, 'bill_id' => $bill->bill_id ])}}"
                               class="btn btn-success pay">
                                Checkout
                            </a>
                        </div>
                    @endif
                @endif


                <div class="text-center mt-4">
                    <a href="{{ route('orders.create', ['table_id' => $restaurant_table->table_id]) }}"
                       class="btn btn-warning">
                        Add New Bill
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-base-layout>

<script>
    $('.add-to-cart').on('click', function () {
        var dishId = $(this).data('dish-id'); // Lấy dish_id từ data attribute
        var quantity = $(this).closest('tr').find('.quantity').val(); // Lấy số lượng từ input
        var billId = '{{ $bill ? $bill->bill_id : null }}'; // Lấy bill_id từ server nếu có

        if (!billId) {
            alert('No active bill for this table. Please create a bill first.');
            return;
        }

        $.ajax({
            url: '{{ route('orders.add') }}', // Route xử lý yêu cầu
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token để bảo mật
                dish_id: dishId, // ID món ăn
                quantity: quantity, // Số lượng món
                bill_id: billId // ID hóa đơn
            },
            success: function (response) {
                // Cập nhật giao diện nếu thêm thành công
                location.reload(); // Reload lại trang
            },
            error: function (response) {
                // Hiển thị thông báo lỗi
                if (response.status === 422) {
                    alert('Validation error: ' + response.responseJSON.message);
                } else {
                    alert('Error adding to cart');
                }
            }
        });
    });

    $('.delete-item').on('click', function () {
        var dishId = $(this).data('dish-id');  // Lấy dish_id từ thuộc tính data-dish-id của nút xóa.

        $.ajax({
            url: '{{ route('orders.remove') }}',  // Đường dẫn tới route xử lý xóa món.
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',   // CSRF token để bảo mật.
                dish_id: dishId   // ID món ăn cần xóa.
            },
            success: function (response) {
                // Reload lại trang khi xóa thành công.
                location.reload();
            },
            error: function (response) {
                alert('Error deleting item');   // Hiển thị thông báo lỗi nếu có vấn đề khi xóa.
            }
        });
    });

</script>
