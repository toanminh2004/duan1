<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('acc_role')->insert([
            'role_id' => "1",
            'account_id' => "1",
        ]);
        DB::table('acc_role')->insert([
            'role_id' => "2",
            'account_id' => "2",
        ]);
    }
}
