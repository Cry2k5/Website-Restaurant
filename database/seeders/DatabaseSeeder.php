<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'anhuahuynh@gmail.com',
                'phone' => '0123456789',
                'address' => '212 Nguyen Dinh Chieu',
                'password' => Hash::make('password'),  // Mật khẩu mặc định
                'role' => 'Admin',
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'phone' => '1234567890',
                'address' => '123 Main Street',
                'password' => Hash::make('password'),  // Mật khẩu mặc định
                'role' => 'Admin',  // Vai trò người dùng
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'phone' => '0987654321',
                'address' => '456 Another St.',
                'password' => Hash::make('password'),  // Mật khẩu mặc định
                'role' => 'Staff',
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@example.com',
                'phone' => '1122334455',
                'address' => '789 Third Ave.',
                'password' => Hash::make('password'),  // Mật khẩu mặc định
                'role' => 'Staff',
            ],

        ]);

        DB::table('categories')->insert([
            ['cate_name' => 'starters'],
            ['cate_name' => 'mains'],
            ['cate_name' => 'desserts'],
            ['cate_name' => 'drinks'],
            ['cate_name' => 'others'],
        ]);
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
        DB::table('dishes')->insert([
            ['cate_id' => 1, 'dish_name' => 'Dish 1', 'image' => 'images/menu-01.jpg', 'dish_price' => '10.00'],
            ['cate_id' => 1, 'dish_name' => 'Dish 2', 'image' => 'images/menu-02.jpg', 'dish_price' => '12.00'],
            ['cate_id' => 1, 'dish_name' => 'Dish 3', 'image' => 'images/menu-03.jpg', 'dish_price' => '14.00'],
            ['cate_id' => 1, 'dish_name' => 'Dish 4', 'image' => 'images/menu-04.jpg', 'dish_price' => '16.00'],
            ['cate_id' => 1, 'dish_name' => 'Dish 5', 'image' => 'images/menu-05.jpg', 'dish_price' => '18.00'],
        ]);

        // Insert data for cate_id = 2
        DB::table('dishes')->insert([
            ['cate_id' => 2, 'dish_name' => 'Dish 6', 'image' => 'images/menu-06.jpg', 'dish_price' => '20.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 7', 'image' => 'images/menu-07.jpg', 'dish_price' => '22.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 8', 'image' => 'images/menu-08.jpg', 'dish_price' => '24.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 9', 'image' => 'images/menu-09.jpg', 'dish_price' => '26.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 10', 'image' => 'images/menu-10.jpg', 'dish_price' => '28.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 11', 'image' => 'images/menu-11.jpg', 'dish_price' => '30.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 12', 'image' => 'images/menu-12.jpg', 'dish_price' => '32.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 13', 'image' => 'images/menu-13.jpg', 'dish_price' => '34.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 14', 'image' => 'images/menu-14.jpg', 'dish_price' => '36.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 15', 'image' => 'images/menu-15.jpg', 'dish_price' => '38.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 16', 'image' => 'images/menu-16.jpg', 'dish_price' => '40.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 17', 'image' => 'images/menu-17.jpg', 'dish_price' => '42.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 18', 'image' => 'images/menu-18.jpg', 'dish_price' => '44.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 19', 'image' => 'images/menu-19.jpg', 'dish_price' => '46.00'],
            ['cate_id' => 2, 'dish_name' => 'Dish 20', 'image' => 'images/menu-20.jpg', 'dish_price' => '48.00'],
        ]);

        // Insert data for cate_id = 3
        DB::table('dishes')->insert([
            ['cate_id' => 3, 'dish_name' => 'Dish 21', 'image' => 'images/menu-21.jpg', 'dish_price' => '50.00'],
            ['cate_id' => 3, 'dish_name' => 'Dish 22', 'image' => 'images/menu-22.jpg', 'dish_price' => '52.00'],
            ['cate_id' => 3, 'dish_name' => 'Dish 23', 'image' => 'images/menu-23.jpg', 'dish_price' => '54.00'],
            ['cate_id' => 3, 'dish_name' => 'Dish 24', 'image' => 'images/menu-24.jpg', 'dish_price' => '56.00'],
            ['cate_id' => 3, 'dish_name' => 'Dish 25', 'image' => 'images/menu-25.jpg', 'dish_price' => '58.00'],
        ]);

        // Insert data for cate_id = 4
        DB::table('dishes')->insert([
            ['cate_id' => 4, 'dish_name' => 'Dish 26', 'image' => 'images/menu-26.jpg', 'dish_price' => '60.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 27', 'image' => 'images/menu-27.jpg', 'dish_price' => '62.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 28', 'image' => 'images/menu-28.jpg', 'dish_price' => '64.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 29', 'image' => 'images/menu-29.jpg', 'dish_price' => '66.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 30', 'image' => 'images/menu-30.jpg', 'dish_price' => '68.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 31', 'image' => 'images/menu-31.jpg', 'dish_price' => '70.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 32', 'image' => 'images/menu-32.jpg', 'dish_price' => '72.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 33', 'image' => 'images/menu-33.jpg', 'dish_price' => '74.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 34', 'image' => 'images/menu-34.jpg', 'dish_price' => '76.00'],
            ['cate_id' => 4, 'dish_name' => 'Dish 35', 'image' => 'images/menu-35.jpg', 'dish_price' => '78.00'],
        ]);
        DB::table('gallery_categories')->insert([
            ['name' => 'Interior'],
            ['name' => 'Food'],
            ['name' => 'Events'],
            ['name' => 'Guests'],
            ['name' => 'Funny'],
            ['name' => 'Reviewer'],
        ]);
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
        DB::table('restaurant_tables')->insert([
            [
                'table_id' => 1,
                'capacity' => 2,
                'state' => 'available',
            ],
            [
                'table_id' => 2,
                'capacity' => 2,
                'state' => 'available',
            ],
            [
                'table_id' => 3,
                'capacity' => 2,
                'state' => 'reserved',
            ],
            [
                'table_id' => 4,
                'capacity' => 4,
                'state' => 'available',
            ],
            [
                'table_id' => 5,
                'capacity' => 4,
                'state' => 'reserved',
            ],
            [
                'table_id' => 6,
                'capacity' => 4,
                'state' => 'available',
            ],
            [
                'table_id' => 7,
                'capacity' => 8,
                'state' => 'available',
            ],
            [
                'table_id' => 8,
                'capacity' => 8,
                'state' => 'unavailable',
            ],
        ]);
    }
}
