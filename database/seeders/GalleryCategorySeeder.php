<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm dữ liệu vào bảng gallery_categories
        DB::table('gallery_categories')->insert([
            ['name' => 'Interior'],
            ['name' => 'Food'],
            ['name' => 'Events'],
            ['name' => 'Guests'],
            ['name' => 'Funny'],
            ['name' => 'Reviewer'],
        ]);
    }
}
