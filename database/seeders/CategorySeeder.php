<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['cate_name' => 'starters'],
            ['cate_name' => 'mains'],
            ['cate_name' => 'desserts'],
            ['cate_name' => 'drinks'],
            ['cate_name' => 'others'],
        ]);
    }
}
