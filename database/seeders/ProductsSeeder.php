<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            'product_name' => "Samsung Galaxy Z Flip6 5G",
            'product_price' => "28000000",
            'product_description' => "Mô tả Samsung Galaxy Z Flip6 5G",
            'product_information' => "Thông tin Samsung Galaxy Z Flip6 5G",
            'product_image' => fake()->imageUrl(),
        ]);
        DB::table('products')->insert([
            'product_name' => "Samsung Galaxy S23 Ultra 5G",
            'product_price' => "23000000",
            'product_description' => "Mô tả Samsung Galaxy S23 Ultra 5G",
            'product_information' => "Thông tin Samsung Galaxy S23 Ultra 5G",
            'product_image' => fake()->imageUrl(),
        ]);
        DB::table('products')->insert([
            'product_name' => "OPPO Reno12 5G",
            'product_price' => "12000000",
            'product_description' => "Mô tả OPPO Reno12 5G",
            'product_information' => "Thông tin OPPO Reno12 5G",
            'product_image' => fake()->imageUrl(),
        ]);
    }
}
