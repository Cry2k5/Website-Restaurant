<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
