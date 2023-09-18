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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
    }
}
