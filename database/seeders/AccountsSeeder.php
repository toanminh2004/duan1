<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('accounts')->insert([
            'account_name' => "toan minh" ,
            'account_address' => "my dinh - ha noi" ,
            'account_email' => "toanminh@gmail.com" ,
            'account_password' => "123" ,
            'account_username' => "minh2004" ,
            'account_phone' => "0868403204" ,
        ]);

        DB::table('accounts')->insert([
            'account_name' => "nguyenmy" ,
            'account_address' => "hoang quoc viet - ha noi" ,
            'account_email' => "nguyenmy@gmail.com" ,
            'account_password' => "456" ,
            'account_username' => "my2005" ,
            'account_phone' => "0868403204" ,
        ]);
    }
}
