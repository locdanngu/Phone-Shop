<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('category')->insert([
            'namecategory' => 'Apple',
            'imagecategory' => '/image/category/apple.png',
            'product_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category')->insert([
            'namecategory' => 'Samsung',
            'imagecategory' => '/image/category/samsung.png',
            'product_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
