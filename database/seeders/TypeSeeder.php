<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('type')->insert([
            'idtype' => 1,
            'nametype' => 'Điện thoại',
            'product_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
    }
}
