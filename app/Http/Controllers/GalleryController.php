<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->paginate(10);
        $categories = GalleryCategory::all();
        return view('admin.galleries', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image=$fileImage->getClientOriginalName();
            $validatedData['image_path'] = 'images/'.$image;
        }

       Gallery::create($validatedData);

        return redirect()->back()->with('success', 'Picture added successfully!');
    }
    public function edit(Gallery $gallery)
    {
        return response()->json($gallery);

    }
    public function update(Request $request,Gallery $gallery)
    {
        $validatedData = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_path' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $fileImage = $request->file('image');
            $image=$fileImage->getClientOriginalName();
            $validatedData['image_path'] = 'images/'.$image;
        }

        $gallery->update($validatedData);

        return redirect()->back()->with('success', 'Picture updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->back()->with('success', 'Picture deleted successfully!');
    }
}

