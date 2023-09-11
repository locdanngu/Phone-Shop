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
            'name' => 'name',
            'adminname' => 'admin',
            'password' => Hash::make('123456'), // Hãy thay thế bằng mật khẩu thật
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

