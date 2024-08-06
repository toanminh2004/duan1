<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';

    public function getAllSale(){
        $sales = DB::table('sales')
        ->leftJoin('pro_sale','sales.sale_id','pro_sale.sale_id')
        ->leftJoin('products','pro_sale.product_id','products.product_id')
        ->select('sales.sale_id','sales.sale_percent',
        'products.product_name','products.product_image')
        ->get();

        return $sales;
    }

    public function getSaleById($sale_id){
        $sale = DB::table('sales')
        ->leftJoin('pro_sale','sales.sale_id','pro_sale.sale_id')
        ->leftJoin('products','pro_sale.product_id','products.product_id')
        ->select('sales.sale_id','sales.sale_percent',
        'products.product_name','products.product_image',
        'products.product_id')
        ->where('sales.sale_id',$sale_id)
        ->first();

        return $sale;
    }

    public function updateSalePro ($data){
        DB::table('pro_sale')->updateOrInsert(
            [
                'sale_id' => $data['sale_id'],
                'product_id' => $data['product_id']
            ]
        );
    }
}
