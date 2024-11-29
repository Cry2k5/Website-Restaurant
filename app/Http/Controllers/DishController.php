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
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        // Lấy tất cả các món ăn
        $dishes = Dish::with(['category'])->paginate(10);  // Bao gồm cả thông tin về category
        return view('admin.dishes',compact('dishes','categories'));  // Trả về view với danh sách món ăn
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

    // Tìm kiếm món ăn
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Bắt đầu truy vấn
        $query = Dish::query();

        // Áp dụng điều kiện tìm kiếm
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('dish_name', 'like', "%{$search}%")
                    ->orWhere('dish_price', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('cate_name', 'like', "%{$search}%");
                    });
            });
        }

        // Phân trang kết quả
        $dishes = $query->paginate(10);

        // Trả về kết quả tìm kiếm dưới dạng JSON
        return response()->json([
            'dishes' => $dishes
        ]);
    }
}
