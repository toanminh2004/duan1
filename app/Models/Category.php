<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public function getAllCat(){
        $cats = DB::table('categories')
        ->select('categories.*')
        ->get();

        return $cats;
    }

    public function getCatHome(){
        $cats = DB::table('categories')
        ->select('categories.*')
        ->where('id','<','3')
        ->get();

        return $cats;
    }

    public function getCatById($id){
        $cate = DB::table('categories')
        ->select('categories.*')
        ->where('id',$id)
        ->first();

        return $cate;
    }
}
