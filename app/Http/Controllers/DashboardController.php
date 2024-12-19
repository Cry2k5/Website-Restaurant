<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;  // Ví dụ về việc lấy dữ liệu hóa đơn
use App\Models\Dish;  // Ví dụ về việc lấy dữ liệu món ăn
use App\Models\User;  // Ví dụ về việc lấy dữ liệu người dùng

class DashboardController extends Controller
{
    public function index()
    {
        // Bạn có thể lấy dữ liệu cần thiết từ các model
        $totalBills = Bill::count();  // Tổng số hóa đơn
        $totalDishes = Dish::count();  // Tổng số món ăn
        $totalUsers = User::count();  // Tổng số người dùng
        $recentBills = Bill::orderBy('payment_time', 'desc')->take(5)->get();  // 5 hóa đơn gần nhất theo payment_time

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Doanh thu hàng tháng
        $monthlyRevenue = [];
        foreach ($months as $month) {
            $monthlyRevenue[] = Bill::whereMonth('payment_time', \Carbon\Carbon::parse($month)->month)
                ->whereYear('payment_time', now()->year)
                ->sum('total');
        }
    
        // Số lượng hóa đơn hàng tháng
        $monthlyOrders = [];
        foreach ($months as $month) {
            $monthlyOrders[] = Bill::whereMonth('payment_time', \Carbon\Carbon::parse($month)->month)
                ->whereYear('payment_time', now()->year)
                ->count();
        }
        // Trả dữ liệu về view
        return view('admin.dashboard', compact('months', 'monthlyRevenue', 'monthlyOrders', 'totalBills', 'totalDishes', 'totalUsers', 'recentBills'));
    }
}
