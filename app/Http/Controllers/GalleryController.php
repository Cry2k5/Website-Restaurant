<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery()
    {
        // Lấy tất cả các danh mục
        $categories = GalleryCategory::all();

        // Lấy tất cả các hình ảnh theo từng danh mục và phân trang (giả sử mỗi trang có 6 ảnh)
        $galleries = Gallery::with('category')->paginate(6);  // 6 ảnh mỗi trang

        return view('home.gallery', compact('categories', 'galleries'));
    }
}
