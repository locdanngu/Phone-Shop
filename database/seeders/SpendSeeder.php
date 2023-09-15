<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpendSeeder extends Seeder
{
    public function run()
    {
        DB::table('spend')->insert([
            'idspend' =>  1,
            'money' => 2000,
            'reason' => 'test 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}