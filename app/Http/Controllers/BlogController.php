<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function index()
    {

//        $user = User::find(2);
        $blogs = Blog::with('user')->paginate(10); // Lấy tất cả bài viết
        return view('admin.blogs', compact('blogs')); // Trả về view với danh sách bài viết
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ]);

        // Lấy user ID của người dùng hiện tại
        $validatedData['user_id'] = Auth::id();

        // Tự động gán ngày hiện tại
        $validatedData['date'] = Carbon::now()->toDateString();

        // Xử lý upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image=$fileImage->getClientOriginalName();
            $validatedData['image'] = 'images/'.$image;
        }

        // Tạo blog
        Blog::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Blog $blog)
    {
        return response()->json($blog);
    }
    public function update(Request $request, Blog $blog)
    {

       $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Lấy user ID của người dùng hiện tại
        $validatedData['user_id'] = $blog->user_id ?? auth()->id();

        // Tự động gán ngày hiện tại
        $validatedData['date'] = Carbon::now()->toDateString();
        // Xử lý upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image=$fileImage->getClientOriginalName();
            $validatedData['image'] = 'images/'.$image;
        }

        $blog->update($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    /**
     * Handle AJAX search request.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Start the query
        $query = Blog::query();

        // Apply search conditions if search term is provided
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $blogs = $query->paginate(10);

        // Return the results as JSON
        return response()->json([
            'blogs' => $blogs
        ]);
    }


}
