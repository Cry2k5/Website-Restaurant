<x-admin-base-layout title="Quản lý hóa đơn">
    <div class="main-content" style="padding: 20px;">
        <h3 class="text-center">Quản lý hóa đơn</h3>

        <!-- Search Input -->
        <div class="d-flex justify-content-between my-3">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Tìm kiếm hóa đơn...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>ID Đặt bàn</th>
                    <th>ID Bàn</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian thanh toán</th>
                    <th>Phương thức thanh toán</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody id="billTableBody">
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->bill_id }}</td>
                        <td>{{ $bill->user->name ?? 'N/A' }}</td>
                        <td>{{ $bill->reservation_id }}</td>
                        <td>{{ $bill->table_id }}</td>
                        <td>{{ $bill->bill_time }}</td>
                        <td>{{ $bill->payment_time ?? 'Chưa thanh toán' }}</td>
                        <td>{{ $bill->payment_method ?? 'N/A' }}</td>
                        <td>
                            <!-- Print Invoice -->
                            <a href="{{ route('orders.print', ['bill_id' => $bill->bill_id]) }}" target="_blank" class="btn btn-warning btn-sm">
                                Print Invoice
                            </a>

                            <!-- Delete Bill -->
                            <form method="POST" action="{{ route('bills.destroy', $bill->bill_id) }}" style="display:inline;">
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
            {{ $bills->links() }}
        </div>
    </div>
</x-admin-base-layout>
