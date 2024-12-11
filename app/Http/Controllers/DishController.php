<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    // Hiển thị danh sách các món ăn
    public function index(Request $request)
    {
        // Khởi tạo truy vấn để lấy tất cả món ăn, bao gồm thông tin danh mục
        $query = Dish::with('category');  // Lấy tất cả món ăn và kèm theo thông tin danh mục (category)

        // Kiểm tra nếu có từ khóa tìm kiếm
        if (isset($request->keyword) && $request->keyword != '') {
            // Tìm kiếm trong tên món ăn, mô tả món ăn, và tên danh mục
            $query->where(function ($query) use ($request) {
                // Tìm kiếm trong 'dish_name' của bảng dishes
                $query->orWhere('dish_name', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('category', function($query) use ($request) {
                        $query->where('cate_name', 'like', '%' . $request->keyword . '%');  // Sửa thành đúng tên cột của bạn
                    });
            });
        }

        // Phân trang kết quả tìm kiếm
        $dishes = $query->paginate(10);

        // Lấy tất cả danh mục để hiển thị trong sidebar hoặc để lọc
        $categories = Category::all();

        // Trả về view với danh sách món ăn và danh mục
        return view('admin.dishes', compact('dishes', 'categories'));
    }


    // Lưu món ăn mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cate_id' => 'required|exists:categories,cate_id',
            'dish_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:255',
            'dish_price' => 'nullable|string|max:255',
        ]);

        // Xử lý upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image = $fileImage->getClientOriginalName();
            $validatedData['image'] = 'images/' . $image;
            $fileImage->storeAs('public/images', $image); // Lưu hình ảnh vào storage
        }

        // Tạo món ăn mới
        Dish::create($validatedData);

        return redirect()->route('dishes.index')->with('success', 'Dish created successfully!');
    }

    // Hiển thị form chỉnh sửa món ăn
    public function edit(Dish $dish_id)
    {

        return response()->json(
            $dish_id
        );
    }

    // Cập nhật món ăn
    public function update(Request $request, Dish $dish_id)
    {
        $validatedData = $request->validate([
            'cate_id' => 'required|exists:categories,cate_id',
            'dish_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'dish_price' => 'nullable|string|max:255',
        ]);
        // Xử lý upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image=$fileImage->getClientOriginalName();
            $validatedData['image'] = 'images/'.$image;
        }

        $dish_id->update($validatedData);

        return redirect()->route('dishes.index')->with('success', 'Dish updated successfully.');
    }

    // Xóa món ăn
    public function destroy(Dish $dish)
    {
        // Xóa hình ảnh cũ nếu có
        if ($dish->image && Storage::exists('public/' . $dish->image)) {
            Storage::delete('public/' . $dish->image);
        }

        $dish->delete();
        return redirect()->route('dishes.index')->with('success', 'Dish deleted successfully.');
    }


}
