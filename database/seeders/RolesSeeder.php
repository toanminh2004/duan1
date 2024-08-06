<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            'role_name' => "Admin",
            'role_description' => "Có quyền chỉnh sửa dữ liệu trang web, quản lí tài nguyên",
        ]);

        DB::table('roles')->insert([
            'role_name' => "User",
            'role_description' => "Có quyền truy cập trang web và mua hàng",
        ]);
    }
}
