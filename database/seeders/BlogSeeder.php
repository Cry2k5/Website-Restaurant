<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy người dùng đầu tiên (admin) từ bảng users
        $user = User::first();  // Lấy user đầu tiên, nếu không có thì bạn có thể tạo một user giả định.

        DB::table('blogs')->insert([
            [
                'title' => 'Delicious Cooking Recipe',
                'user_id' => $user->id, // ID của người dùng, giả sử user_id = 1
                'description' => 'A simple and delicious recipe for cooking.',
                'date' => Carbon::now(), // Ngày hiện tại
                'image' => 'images/blog-01.jpg', // Đường dẫn ảnh bài viết
            ],
            [
                'title' => 'Exciting Event Recap',
                'user_id' => $user->id, // ID của người dùng, giả sử user_id = 2
                'description' => 'A recap of the exciting event that took place recently.',
                'date' => Carbon::now()->subDays(3), // 3 ngày trước
                'image' => 'images/blog-02.jpg',
            ],
            [
                'title' => 'Traveling to Paris: A Guide',
                'user_id' => $user->id, // ID của người dùng, giả sử user_id = 3
                'description' => 'The ultimate guide to traveling to Paris with tips and tricks.',
                'date' => Carbon::now()->subDays(7), // 7 ngày trước
                'image' => 'images/blog-03.jpg',
            ],
            [
                'title' => 'The Future of Technology',
                'user_id' => $user->id,
                'description' => 'An overview of the advancements in technology in the next decade.',
                'date' => Carbon::now()->subDays(10),
                'image' => 'images/blog-04.jpg',
            ],
            [
                'title' => 'Healthy Lifestyle Tips',
                'user_id' => $user->id,
                'description' => 'Simple tips for maintaining a healthy lifestyle.',
                'date' => Carbon::now()->subDays(14),
                'image' => 'images/blog-05.jpg',
            ],
        ]);
    }
}
