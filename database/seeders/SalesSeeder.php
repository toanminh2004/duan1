<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sales')->insert([
            'sale_percent' => "20",
        ]);

        DB::table('sales')->insert([
            'sale_percent' => "50",
        ]);

        DB::table('sales')->insert([
            'sale_percent' => "80",
        ]);
    }
}
