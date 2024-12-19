<x-admin-base-layout title="Dashboard">
    <div class="main-content" style="padding: 20px;">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Tổng số hóa đơn -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Total Orders</h4>
                        <p class="card-text h2 text-secondary">{{ number_format($totalBills) }} Orders</p>
                    </div>
                </div>
            </div>

            <!-- Tổng số món ăn -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title text-success">Total Dishes</h4>
                        <p class="card-text h2 text-secondary">{{ number_format($totalDishes) }} Dishes</p>
                    </div>
                </div>
            </div>

            <!-- Tổng số người dùng -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title text-warning">Total Users</h4>
                        <p class="card-text h2 text-secondary">{{ number_format($totalUsers) }} Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ Doanh thu theo tháng -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title">Monthly Revenue</h4>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ Số lượng hóa đơn theo tháng -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title">Monthly Orders</h4>
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hóa đơn gần nhất -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title">Recent Orders</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Payment Time</th>
                                        <th scope="col">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentBills as $bill)
                                        <tr>
                                            <td>{{ $bill->bill_id }}</td>
                                            <td>{{ $bill->payment_time ? \Carbon\Carbon::parse($bill->payment_time)->format('d-m-Y H:i') : 'Not Paid' }}</td>
                                            <td>{{ number_format($bill->total) }} đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <!-- Scripts -->
    <script>
        // Biểu đồ Doanh thu theo tháng
        var revenueChartCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueChartCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!}, // Các tháng
                datasets: [{
                    label: 'Revenue (đ)',
                    data: {!! json_encode($monthlyRevenue) !!}, // Dữ liệu doanh thu tháng
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ Số lượng hóa đơn theo tháng
        var ordersChartCtx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ordersChartCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!}, // Các tháng
                datasets: [{
                    label: 'Orders Count',
                    data: {!! json_encode($monthlyOrders) !!}, // Dữ liệu số lượng hóa đơn tháng
                    backgroundColor: '#1cc88a',
                    borderColor: '#1cc88a',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-admin-base-layout>
