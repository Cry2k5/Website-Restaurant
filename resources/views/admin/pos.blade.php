<x-admin-base-layout title="POS - Table Management">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Table Management</h1>

        <div class="row">
            <!-- Iterate through tables and display -->
            @foreach($restaurant_tables as $table)
                <div class="col-md-3 col-sm-6 mb-4">
                    <!-- Kiểm tra xem có hóa đơn nào cho bàn này không -->
                    @php
                        // Lọc các hóa đơn theo table_id và lấy hóa đơn cuối cùng
                        $bill = $bills->filter(function ($bill) use ($table) {
                            return $bill->table_id == $table->table_id;
                        })->last(); // Lấy hóa đơn cuối cùng
                    @endphp

                    <a href="{{ route('orders.index', ['table_id' => $table->table_id, 'bill_id' => $bill ? $bill->bill_id : '#']) }}" class="text-decoration-none">
                        <div class="card text-center shadow"
                             style="border: 2px solid {{ $table->state == 'available' ? '#28a745' : ($table->state == 'reserved' ? '#ffc107' : '#dc3545') }};">
                            <div class="card-body">
                                <h5 class="card-title">Table {{ $table->table_id }}</h5>
                                <p class="card-text">
                                    Capacity: {{ $table->capacity }}
                                </p>
                                <span class="badge"
                                      style="background-color: {{ $table->state == 'available' ? '#28a745' : ($table->state == 'reserved' ? '#ffc107' : '#dc3545') }}; color: white;">
                                    {{ ucfirst($table->state) }}
                                </span>

                                <!-- Hiển thị thông tin hóa đơn nếu có -->
                                @if($bill)
                                    <p class="mt-2">Bill ID: {{ $bill->bill_id }}</p>
                                @else
                                    <p class="mt-2 text-muted">No Bill</p>
                                @endif

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-base-layout>
