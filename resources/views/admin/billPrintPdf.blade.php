<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .invoice {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .total {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="header">
        <h1>Restaurant Invoice</h1>
        <p>Table: {{ $bill->table->table_id }}</p>
        <p>Date: {{ $bill->bill_time }}</p>
    </div>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bill->billItems as $item)
            <tr>
                <td>{{ $item->dish->dish_name }}</td>
                <td>{{ number_format($item->dish->dish_price) }} đ</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->dish->dish_price * $item->quantity) }} đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Cart Total:</strong> {{ number_format($total) }} đ</p>
        <p><strong>Tax (10%):</strong> {{ number_format($tax) }} đ</p>
        <p><strong>Grand Total:</strong> {{ number_format($grandTotal) }} đ</p>
    </div>
</div>
</body>
</html>
