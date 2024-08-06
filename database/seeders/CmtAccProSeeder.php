<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmtAccProSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('cmt_acc_pro')->insert([
            'product_id' => "1",
            'account_id' => "1",
            'comment_id' => "1",
        ]);
        DB::table('cmt_acc_pro')->insert([
            'product_id' => "2",
            'account_id' => "2",
            'comment_id' => "2",
        ]);
        DB::table('cmt_acc_pro')->insert([
            'product_id' => "3",
            'account_id' => "2",
            'comment_id' => "3",
        ]);
    }
}
