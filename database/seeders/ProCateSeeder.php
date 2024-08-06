<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_category')->insert([
            'product_id' => "4",
            'category_id' => "2",
        ]);
        DB::table('product_category')->insert([
            'product_id' => "5",
            'category_id' => "2",
        ]);
        DB::table('product_category')->insert([
            'product_id' => "6",
            'category_id' => "3",
        ]);
    }
}
