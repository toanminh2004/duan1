<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    // xác định khóa chính
    protected $primaryKey = 'product_id';

    public function getAllPro(){
        $pros = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','product_category.category_id','categories.id')
        ->select('products.product_id','product_name','product_image',
                'product_description','product_price','product_information',
                'product_category.category_id','categories.category_name',
                'pro_sale.sale_id','sales.sale_percent')
        ->get();

        return $pros;
    }

    public function getAllProHome(){
        $pros = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','product_category.category_id','categories.id')
        ->select('products.product_id','product_name','product_image',
                'product_description','product_price','product_information',
                'product_category.category_id','categories.category_name',
                'pro_sale.sale_id','sales.sale_percent')
        ->where('product_category.category_id','<','3')
        ->get();

        return $pros;
    }

    public function getAllSale(){
        $sales = DB::table('sales')
        ->leftJoin('pro_sale','sales.sale_id','pro_sale.sale_id')
        ->leftJoin('products','pro_sale.product_id','products.product_id')
        ->select('sales.sale_id','sales.sale_percent',
        'products.product_name','products.product_image')
        ->get();

        return $sales;
    }

    public function getAllComment(){
        $comments = DB::table('comments')
        ->leftJoin('cmt_acc_pro','comments.comment_id','cmt_acc_pro.comment_id')
        ->leftJoin('users','users.id','cmt_acc_pro.account_id')
        ->select('comments.comment_content','users.name',
        'comments.comment_id')
        ->get();

        return $comments;
    }

    public function getProById($id){
        $pro = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('cmt_acc_pro','products.product_id','cmt_acc_pro.product_id')
        ->leftJoin('comments','cmt_acc_pro.comment_id','comments.comment_id')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','product_category.category_id','categories.id')
        ->select('products.product_id','product_name','product_image',
                'product_description','product_price','product_information',
                'product_category.category_id','categories.category_name',
                'comments.comment_content','comments.comment_id','sales.sale_percent')
        ->where('products.product_id',$id)
        ->first();

        return $pro;
    }

    public function getProSale(){
        $proSales = DB::table('pro_sale')
        ->leftJoin('sales', 'pro_sale.sale_id', 'sales.sale_id')
        ->leftJoin('products', 'pro_sale.product_id', 'products.product_id')
        ->select('pro_sale.product_id', 'products.product_name', 'products.product_image',
        'products.product_price', 'sales.sale_percent', 'products.product_description',
        'pro_sale.sale_id')
        ->limit(6)
        ->get();

        return $proSales;
    }

    public function insertPro($data) {

        DB::table('product_category')->insert(
            [
                'category_id' => $data['category_id'],
                'product_id' => $data['product_id']
            ]
        );
    }

    public function updatePro($data)
{

    DB::table('product_category')->updateOrInsert(
        ['product_id' => $data['product_id']],
        ['category_id' => $data['category_id']]
    );

  
}
public function addPro($data) {
        
}
}
