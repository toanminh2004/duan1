<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleAdController extends Controller
{
    public $pros;

    public $sales;

    public $carts;

    public function __construct(){
        $this->pros = new Product(); 
        $this->carts = new Cart();
        $this->sales = new Sale();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listSale = $this->pros->getAllSale();

        return view('admin.sale.list',['sales'=>$listSale]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listProduct = $this->pros->getAllPro();
        return view('admin.sale.add',['products'=>$listProduct]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $saleId = DB::table('sales')->insertGetId(
            [
                'sale_percent' => $request->sale_percent,
            ]
        );
        $data = [
            'sale_id' => $saleId,
            'product_id' => $request->product_id
        ];

        $this->carts->insertSalePro($data);

        return redirect()->route('ad-sale.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $listPro = $this->pros->getAllPro();
        $sale = $this->sales->getSaleById($id);

        return view('admin.sale.update',
        ['products'=>$listPro,'sale'=>$sale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $sale = DB::table('sales')->where('sale_id',$id)->first();

        DB::table('sales')->where('sale_id',$id)->update(
            [
                'sale_percent' => $request->sale_percent,
            ]
        );
        $data = [
            'sale_id' => $id,
            'product_id' => $request->product_id
        ];

        $this->sales->updateSalePro($data);

        return redirect()->route('ad-sale.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
