<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy tất cả các bài viết với thông tin người đăng (eager load user)
        $blogs = Blog::with('user')->paginate(3);


        // Trả về view và truyền dữ liệu bài viết
        return view('home.blog', compact('blogs'));
    }
    public function create(){
        $blogs = Blog::with('user')  // Kết hợp với bảng users
        ->orderBy('date', 'desc') // Sắp xếp theo ngày giảm dần
        ->take(3)                 // Lấy 3 bài viết mới nhất
        ->get();                  // Thực hiện truy vấn và lấy dữ liệu

        // Trả về view và truyền dữ liệu bài viết
        return view('home.index', compact('blogs'));
    }
}
