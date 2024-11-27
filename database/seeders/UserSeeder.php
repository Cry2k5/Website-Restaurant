<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
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
            // Thêm các bản ghi khác nếu cần
        ]);
    }

}
