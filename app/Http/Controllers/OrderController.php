<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Dish;
use App\Models\RestaurantTable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

use function Laravel\Prompts\table;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $table_id = $request->input('table_id');

        // Kiểm tra xem table_id có tồn tại hay không
        $table = RestaurantTable::find($table_id);
        // Tạo một hóa đơn mới
        $bill = Bill::create([
            'reservation_id' => null,
            'table_id' => $table_id,
            'user_id' => auth()->user()->id,
            'bill_time' => now(),
            'payment_method' => null,
        ]);
        $table->update([
            'state' => 'unavailable',
        ]);
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
    
        // Lấy món ăn
        $dish = Dish::find($request->dish_id);
    
        if (!$dish) {
            return response()->json(['message' => 'Dish not found'], 404);
        }
    
        // Lấy hóa đơn
        $bill = Bill::with('table', 'user', 'billItems')->find($request->bill_id);
    
        if (!$bill) {
            return response()->json(['message' => 'Bill not found'], 404);
        }
    
        // Kiểm tra món ăn đã có trong hóa đơn chưa
        $existingItem = BillItem::where('bill_id', $bill->bill_id)
            ->where('dish_id', $dish->dish_id)
            ->first();
    
        if ($existingItem) {
            // Nếu đã có, chỉ cần cập nhật số lượng
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            // Nếu chưa có, tạo mới một bản ghi BillItem
            BillItem::create([
                'bill_id' => $bill->bill_id,
                'dish_id' => $dish->dish_id,
                'quantity' => $request->quantity,
            ]);
        }
          
        // Trả về kết quả
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
        $bill->update([
            'total' =>    number_format($grandTotal),         
        ]);
        return view('admin.checkout', [
            'bill' => $bill,
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
            'restaurant_table' => $table,
            'billItems' => $billItems,
        ]);
    }
    public function vnpayReturn(Request $request)
    {
        $inputData = $request->all();
        $vnp_HashSecret = "64FSDNRCRT7Z4X4WQHMC9B6FPMUZX02D"; // Key bí mật của VNPay
    
        // Kiểm tra secure hash
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
    
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                $bill = Bill::find($inputData['vnp_TxnRef']);
                if ($bill) {
                    $bill->payment_time = now();
                    $bill->payment_method = 'vnpay';
                    $bill->save();
                    $bill->table->update(['state' => 'available']);
                    return redirect()->route('orders.view')->with('success', 'Payment completed successfully via VNPay!');
                }
                return redirect()->route('orders.view')->with('error', 'Bill not found!');
            }
            return redirect()->route('orders.view')->with('error', 'Payment failed via VNPay!');
        }
    
        return redirect()->route('orders.view')->with('error', 'Invalid secure hash!');
    }
    
    // Thanh toán hóa đơn
    public function checkout(Request $request)
    {
        $request->validate([
            'bill_id' => 'required|integer|exists:bills,bill_id',
            'payment_method' => 'required|string',
            'table_id' => 'required|integer|exists:restaurant_tables,table_id',
        ]);
    
        $bill = Bill::find($request->bill_id);
        $table = RestaurantTable::find($request->table_id);
    
        if (!$bill || !$table) {
            return redirect()->route('orders.view')->with('error', 'Invalid bill or table data.');
        }
    
        if ($request->payment_method === 'cash') {
            // Xử lý thanh toán bằng tiền mặt
            $bill->payment_time = now();
            $bill->payment_method = $request->payment_method;
            $bill->save();
            $table->update(['state' => 'available']);
            return redirect()->route('orders.view')->with('success', 'Payment completed successfully!');
        } elseif ($request->payment_method === 'vnpay') {

            $timezone = 'Asia/Ho_Chi_Minh';

            $currentTime = Carbon::now($timezone);

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('orders.vnpay_return');
            $vnp_TmnCode = "PNRM6YWF";//Mã website tại VNPAY 
            $vnp_HashSecret = "64FSDNRCRT7Z4X4WQHMC9B6FPMUZX02D"; //Chuỗi bí mật
            
            $vnp_TxnRef = $request->bill_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
            $vnp_OrderInfo = "Paymenting...";
            $vnp_OrderType = "Anh Hua Restaurant";
            $vnp_Amount = intval(round($bill->total * 100000)); // Tổng tiền VNĐ x100, đảm bảo là số nguyên
             $vnp_Locale = "VN";
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $request->ip();
            $vnp_CreateDate = $currentTime->format('YmdHis');
            //Add Params of 2.0.1 Version
            $expireDate = $currentTime->copy()->addMinutes(15)->format('YmdHis');            //Billing
          
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" =>  $vnp_CreateDate,
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=> $expireDate,
                "vnp_BankCode" => $vnp_BankCode,


            ];
            
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                     return redirect()->away($vnp_Url);
                }
            
            }  
        return redirect()->route('orders.view')->with('error', 'Payment method not supported.');
    
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
