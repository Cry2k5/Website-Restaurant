<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
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
