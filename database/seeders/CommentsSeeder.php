<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('comments')->insert([
            'comment_content' => "Comment 1",
        ]);
        DB::table('comments')->insert([
            'comment_content' => "Comment 2",
        ]);
        DB::table('comments')->insert([
            'comment_content' => "Comment 3",
        ]);
    }
}
