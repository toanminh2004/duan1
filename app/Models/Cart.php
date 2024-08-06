<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'account_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCart($id){
        $cart = DB::table('carts')->first();

        return $cart;
    }

    public function getBill($id){
        $userId = Auth::user()->id;
        $listBill = DB::table('billes')
        ->leftJoin('carts','billes.cart_id','carts.cart_id')
        ->leftJoin('users','users.id','carts.account_id')
        ->leftJoin('cart_pro','cart_pro.cart_id','carts.cart_id')
        ->leftJoin('products','products.product_id','cart_pro.product_id')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','categories.id','product_category.category_id')
        ->select('carts.cart_id','users.name','users.phone',
        'users.email','users.address',
        'products.product_name','products.product_price','cart_pro.quantity',
        'products.product_id','categories.category_name')
        ->where('users.id',$userId)
        ->where('carts.cart_id',$id)
        ->first();

        return $listBill;
    }

    public function getProByCart($id){
        $proCart = DB::table('products')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','product_category.category_id','categories.id')
        ->leftJoin('cart_pro','cart_pro.product_id','products.product_id')
        ->leftJoin('carts','carts.cart_id','cart_pro.cart_id')
        ->select('products.product_id','products.product_name',
        'products.product_price','categories.category_name','cart_pro.quantity')
        ->where('carts.cart_id',$id)
        ->get();

        return $proCart;
    }

    public function insertSalePro ($data){
        DB::table('pro_sale')->insert(
            [
                'sale_id' => $data['sale_id'],
                'product_id' => $data['product_id']
            ]
        );
    }

}