<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listBill = DB::table('billes')
        ->leftJoin('status_bill','status_bill.bill_id','billes.id')
        ->leftJoin('status_of_bill','status_of_bill.id','status_bill.status_id')
        ->leftJoin('carts','carts.cart_id','billes.cart_id')
        ->select('billes.id','status_of_bill.id as status_id','billes.name'
        ,'status_of_bill.name as status_name','billes.phone','billes.address')
        ->get();

        return view('admin.bill.list',['billes'=>$listBill]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pros = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('bill_extra','bill_extra.product_id','products.product_id')
        ->leftJoin('billes','billes.id','bill_extra.bill_id')
        ->leftJoin('carts','carts.cart_id','billes.cart_id')
        ->leftJoin('users','users.id','carts.account_id')
        ->leftJoin('status_bill','status_bill.bill_id','billes.id')
        ->leftJoin('status_of_bill','status_of_bill.id','status_bill.status_id')
        ->select('product_name','product_price','status_of_bill.name','billes.id',
        'bill_extra.quantity','sales.sale_percent','product_image','products.product_id')
        ->where('billes.id',$id)
        ->get();

        $bill = DB::table('billes')
        ->leftJoin('status_bill', 'status_bill.bill_id', '=', 'billes.id')
        ->leftJoin('status_of_bill', 'status_of_bill.id', '=', 'status_bill.status_id')
        ->leftJoin('carts', 'carts.cart_id', '=', 'billes.cart_id')
        ->select(
            'billes.id', 
            'status_of_bill.id as status_id', 
            'billes.name', 
            'status_of_bill.name as status_name', 
            'billes.phone', 
            'billes.address'
        )
        ->where('billes.id', $id)
        ->first();

        $status = DB::table('status_of_bill')
        ->get();

        return view('admin.bill.update',['bill'=>$bill,'products'=>$pros,'status'=>$status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('status_bill')
        ->where('bill_id',$id)
        ->update([
            'status_id' => $request->id,
        ]);

        return redirect()->route('ad-bill.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
