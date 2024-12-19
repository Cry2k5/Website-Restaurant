<x-admin-base-layout title="Checkout Page">
    <div class="main-content">
        <h1 class="text-center mb-4">Checkout for Table {{ $restaurant_table->table_id }}</h1>

        <!-- Bill Summary -->
        <div class="card">
            <div class="card-header">
                <h3>Bill Summary</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-height: 350px ; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($billItems as $item)
                            <tr>
                                <td>{{ $item->dish->dish_name }}</td>
                                <td>{{ number_format($item->dish->dish_price) }} đ</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->dish->dish_price * $item->quantity) }} đ</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="mt-4">
                    <p><strong>Cart Total:</strong> {{ number_format($total) }} đ</p>
                    <p><strong>Cart Taxed (10%):</strong> {{ number_format($total * 0.10) }} đ</p>
                    <p><strong>Grand Total:</strong> {{ number_format($total + $total * 0.10) }} đ</p>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Payment Method</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="bill_id" value="{{ $bill->bill_id }}">
                    <input type="hidden" name="table_id" value="{{ $restaurant_table->table_id }}">

                    <div class="form-group">
                        <label for="payment-method">Select Payment Method:</label>
                        <select id="payment-method" name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="vnpay">VN PayPay</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success">Confirm Payment</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="{{ route('orders.print', ['bill_id' => $bill->bill_id]) }}" class="btn btn-primary">
                        Print Invoice
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-admin-base-layout>

