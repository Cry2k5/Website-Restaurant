<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        // Lấy 3 bài viết mới nhất từ BlogController
        $blogs = Blog::with('user')  // Eager load bảng 'user'
        ->orderBy('date', 'desc') // Sắp xếp bài viết theo ngày giảm dần
        ->take(3)                 // Lấy 3 bài viết mới nhất
        ->get();                  // Thực thi truy vấn và lấy kết quả

        // Trả về view 'home.index' và truyền dữ liệu blogs
        return view('home.index', compact('blogs'));
    }
    public function menu(){
        return view('home.menu');
    }
    public function reservation(){
        return view('home.reservation');
    }
    public function gallery(){
        return view('home.gallery');
    }
    public function about(){
        return view('home.about');
    }
    public function blog(){
        return view('home.blog');
    }
    public function contact(){
    return view('home.contact');
    }

}
