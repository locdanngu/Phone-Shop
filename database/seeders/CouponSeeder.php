<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    public function run()
    {
        DB::table('coupon')->insert([
            'code' => 'TEST123',
            'starttime' => now(),
            'endtime' => now()->addDays(30),
            'applicable_to' => 'cart',
            'iduser' => null,
            'product_list' => 0,
            'discount_type' => 'percentage',
            'minimum_order_amoun' => 100,
            'max_discount_amount' => 50,
            'discount_amount' => 20,
        ]);
    }
}
