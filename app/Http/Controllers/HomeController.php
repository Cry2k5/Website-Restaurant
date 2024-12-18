<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        // Lấy 3 bài viết mới nhất từ BlogController
        $blogs = Blog::with('user')  // Eager load bảng 'user'
        ->orderBy('date', 'desc') // Sắp xếp bài viết theo ngày giảm dần
        ->take(2)                 // Lấy 3 bài viết mới nhất
        ->get();                  // Thực thi truy vấn và lấy kết quả

        // Trả về view 'home.index' và truyền dữ liệu blogs
        return view('home.index', compact('blogs'));
    }
    public function menu(){
        $categories = Category::with('dishes')->get(); // Eager load dishes for each category
        return view('home.menu', compact('categories'));
    }
    public function reservation(){
        return view('home.reservation');
    }
    public function gallery()
    {
        // Lấy tất cả các danh mục
        $categories = GalleryCategory::all();

        // Lấy tất cả các hình ảnh theo từng danh mục và phân trang (giả sử mỗi trang có 6 ảnh)
        $galleries = Gallery::with('category')->paginate(6);  // 6 ảnh mỗi trang

        return view('home.gallery', compact('categories', 'galleries'));
    }
    public function about(){
        return view('home.about');
    }
    public function blog()
    {
        // Lấy tất cả các bài viết với thông tin người đăng, sắp xếp bài mới nhất trước
        $blogs = Blog::with('user')->orderBy('date', 'desc')->paginate(10);

        // Trả về view và truyền dữ liệu bài viết
        return view('home.blog', compact('blogs'));
    }

    public function contact(){
    return view('home.contact');
    }

}
