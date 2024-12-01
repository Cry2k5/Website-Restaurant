<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Dish;
use App\Models\RestaurantTable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use function Laravel\Prompts\table;

class OrderController extends Controller
{
    // Tạo hóa đơn mới cho bàn và chuyển hướng tới trang chi tiết
    public function create(Request $request)
    {
        // Lấy table_id từ request
        $table_id = $request->input('table_id');

        // Tạo một hóa đơn mới
        $bill = Bill::create([
            'reservation_id' => null,
            'table_id' => $table_id,
            'user_id' => auth()->user()->id, // Liên kết với người dùng hiện tại
            'bill_time' => now(), // Thời gian tạo hóa đơn
            'payment_method' => null, // Có thể thay đổi
        ]);

        // Chuyển hướng đến trang chi tiết hóa đơn
        return redirect()->route('orders.index', ['table_id' => $table_id, 'bill_id' => $bill->bill_id])->with('success', 'Tạo hóa đơn mới thành công!!');
    }

    // Trang POS (Quản lý bàn)
    public function posIndex()
    {
        $tables = RestaurantTable::all();
        $bills = Bill::with('table', 'reservation')->get();

        return view('admin.pos', [
            'restaurant_tables' => $tables,
            'bills' => $bills,
        ]);
    }

    // Trang quản lý đơn hàng
    public function index(Request $request)
    {
        $dishes = Dish::with('category')->get();

        $table = RestaurantTable::find($request->table_id);
        $total = 0;

        $billItems = [];

        // Tìm hóa đơn cho bàn và lấy danh sách các món trong hóa đơn đó
        $bill = Bill::with('table', 'user', 'billItems')
            ->find($request->bill_id); // Lấy hóa đơn theo bill_id từ request
        if ($bill) {
            $billItems = BillItem::with('dish','bill')->where('bill_id', $bill->bill_id)->get();
            $total = $billItems->sum(function ($item) {
                return $item->quantity * $item->dish->dish_price; // Tổng từng món = số lượng * giá món
            });
        }

        return view('admin.orders', [
            'bill' =>$bill,
            'dishes' => $dishes,
            'billItems' => $billItems,
            'restaurant_table' => $table,
            'total'=>$total
        ]);
    }

    // Thêm món vào giỏ hàng
    public function addToCart(Request $request)
    {
        $request->validate([
            'dish_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'bill_id' => 'required|integer',
        ]);

        $dish = Dish::find($request->dish_id);

        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }

        $bill = Bill::with('table', 'user', 'billItems')->find($request->bill_id);

        if (!$bill) {
            return response()->json(['message' => 'Bill not found'], 404);
        }

        // Kiểm tra món đã có trong hóa đơn chưa
        $existingItem = BillItem::where('bill_id', $bill->bill_id)
            ->where('dish_id', $dish->dish_id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            BillItem::create([
                'bill_id' => $bill->bill_id,
                'dish_id' => $dish->dish_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('orders.index', ['table_id' => $bill->table->table_id])
            ->with('success', 'Dish added to cart successfully!');
    }



    // Cập nhật giỏ hàng (số lượng món)
    public function updateCart(Request $request)
    {
        $request->validate([
            'dish_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        if (session()->has('bill_id')) {
            $bill = Bill::find(session()->get('bill_id'));
            $billItem = $bill->billItems()->where('dish_id', $request->dish_id)->first();

            if ($billItem) {
                $billItem->quantity = $request->quantity;
                $billItem->save();
            }
        }

        return response()->json(['cart' => $bill->billItems->load('dish')]);
    }

    // Xóa món khỏi giỏ hàng
    public function removeFromCart(Request $request)
    {
        $request->validate(['dish_id' => 'required|integer']);

        if (session()->has('bill_id')) {
            $bill = Bill::find(session()->get('bill_id'));
            $bill->billItems()->where('dish_id', $request->dish_id)->delete();
        }

        return response()->json(['cart' => $bill->billItems->load('dish')]);
    }

    public function showCheckout(Request $request)
    {
        $table = RestaurantTable::find($request->table_id);

        $bill = Bill::with('table', 'user', 'billItems')
            ->find($request->bill_id); // Lấy hóa đơn theo bill_id từ request
        $billItems = $bill->billItems;

        // Tính toán tổng tiền, thuế và các thông tin khác
        $total = $bill->billItems->sum(function ($item) {
            return $item->quantity * $item->dish->dish_price;
        });
        $tax = $total * 0.1;
        $grandTotal = $total + $tax;

        return view('admin.checkout', [
            'bill' => $bill,
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
            'restaurant_table' => $table,
            'billItems' => $billItems,
        ]);
    }

    // Thanh toán hóa đơn
    public function checkout(Request $request)
    {
        // Kiểm tra và validate input
        $request->validate([
            'bill_id' => 'required|integer|exists:bills,bill_id', // Đảm bảo bill_id tồn tại
            'payment_method' => 'required|string', // Đảm bảo có phương thức thanh toán
        ]);

        // Lấy bill_id
        $bill = Bill::find($request->bill_id);

        if (!$bill) {
            return redirect()->route('orders.view')->with('error', 'Bill not found!');
        }

        // Cập nhật thời gian thanh toán và phương thức thanh toán
        $bill->payment_time = now();
        $bill->payment_method = $request->payment_method; // Lưu phương thức thanh toán (nếu có cột này trong bảng)
        $bill->save();

        return redirect()->route('orders.view')->with('success', 'Payment completed successfully!');
    }

    public function printInvoice($bill_id)
    {
        // Tìm bill và các item liên quan
        $bill = Bill::with(['billItems.dish', 'table'])->find($bill_id);

        if (!$bill) {
            return redirect()->back()->with('error', 'Bill not found!');
        }

        $total = $bill->billItems->sum(fn($item) => $item->dish->dish_price * $item->quantity);
        $tax = $total * 0.10;
        $grandTotal = $total + $tax;

        // Dữ liệu gửi đến view
        $data = [
            'bill' => $bill,
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
        ];

        // Tạo PDF (sử dụng DOMPDF)
        $pdf = Pdf::loadView('admin.billPrintPdf', $data);

        // Trả về PDF để tải xuống
        return $pdf->stream("Invoice_Table_{$bill->table->table_id}.pdf");
    }

}
