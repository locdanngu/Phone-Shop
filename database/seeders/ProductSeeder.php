<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            'nameproduct' => 'IPhone 14 256GB',
            'oldprice' => 1000,
            'price' => 700,
            'detail' => 'Mô tả sản phẩm 1',
            'imageproduct' => '/image/product/iPhone-14-256GB.png',
            'timedelete' => null,
            'idcategory' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product')->insert([
            'nameproduct' => 'Samsung Galaxy S4 Mini',
            'oldprice' => 700,
            'price' => 500,
            'detail' => 'Mô tả sản phẩm 2',
            'imageproduct' => '/image/product/Samsung-Galaxy-S4-Mini.png',
            'timedelete' => null,
            'idcategory' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
