<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm dữ liệu vào bảng galleries
        DB::table('galleries')->insert([
            [
                'gallery_category_id' => 1, // Liên kết với danh mục 'Interior'
                'image_path' => 'images/photo-gallery-13.jpg',
            ],
            [
                'gallery_category_id' => 2, // Liên kết với danh mục 'Food'
                'image_path' => 'images/photo-gallery-14.jpg',
            ],
            [
                'gallery_category_id' => 3, // Liên kết với danh mục 'Events'
                'image_path' => 'images/photo-gallery-15.jpg',
            ],
            [
                'gallery_category_id' => 4, // Liên kết với danh mục 'Guests'
                'image_path' => 'images/photo-gallery-16.jpg',
            ],
            [
                'gallery_category_id' => 1, // Liên kết với danh mục 'Interior'
                'image_path' => 'images/photo-gallery-17.jpg',
            ],
            [
                'gallery_category_id' => 2, // Liên kết với danh mục 'Food'
                'image_path' => 'images/photo-gallery-18.jpg',
            ],
            [
                'gallery_category_id' => 3, // Liên kết với danh mục 'Events'
                'image_path' => 'images/photo-gallery-19.jpg',
            ],
            [
                'gallery_category_id' => 4, // Liên kết với danh mục 'Guests'
                'image_path' => 'images/photo-gallery-20.jpg',
            ],
            [
                'gallery_category_id' => 4, // Liên kết với danh mục 'Guests'
                'image_path' => 'images/photo-gallery-21.jpg',
            ],
        ]);
    }
}
