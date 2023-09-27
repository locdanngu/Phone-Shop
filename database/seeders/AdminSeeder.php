<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin')->insert([
            'name' => 'admin',
            'adminname' => 'admin',
            'password' => Hash::make('123456'), // Hãy thay thế bằng mật khẩu thật
            'role' => 'admin',
            'product' => 1,
            'coupon' => 1,
            'user' => 1,
            'order' => 1,
            'revenue' => 1,
            'contact' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admin')->insert([
            'name' => 'admin123',
            'adminname' => 'admin123',
            'password' => Hash::make('123456'), // Hãy thay thế bằng mật khẩu thật
            'role' => 'staff',
            'product' => 0,
            'coupon' => 0,
            'user' => 0,
            'order' => 0,
            'revenue' => 0,
            'contact' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

