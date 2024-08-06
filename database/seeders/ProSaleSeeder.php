<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pro_sale')->insert([
            'product_id' => "1",
            'sale_id' => "1",
        ]);
        DB::table('pro_sale')->insert([
            'product_id' => "2",
            'sale_id' => "3",
        ]);
    }
}
