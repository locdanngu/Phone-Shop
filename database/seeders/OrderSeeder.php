<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            'iduser' =>  1,
            'status' => 'done',
            'totalprice' => 2000,
            'note' => 'Giao hàng nhanh',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('orders_product')->insert([
            'idorder' => 1,
            'idproduct' => 1,
            'quantity' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
