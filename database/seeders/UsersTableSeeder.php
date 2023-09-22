<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'admin',
            'password' => Hash::make('123456'), // Hash mật khẩu
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'status' => 'ok',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

