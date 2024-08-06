<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\table;

class ProAdController extends Controller
{

    public $pros;

    public $cates;

    public function __construct(){
        $this->pros = new Product();
        $this->cates = new Category();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listPro = $this->pros->getAllPro();
        return view('admin.product.list',['products'=>$listPro]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listCate = $this->cates->getAllCat();

        return view('admin.product.add',['categories'=>$listCate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if($request->hasFile('product_image')) {
            $filename = $request->file('product_image')->store('products','public');
        } else {
            $filename = null;
        }

        $productId = DB::table('products')->insertGetId(
            [
                'product_image' => $filename,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description,
                'product_information' => $request->product_information,
            ]
        );
        $data = [
            'product_id' => $productId,
            'category_id' => $request->category_id
        ];

        $this->pros->insertPro($data);

        return redirect()->route('ad-product.index');

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
        $product = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('product_category','products.product_id','product_category.product_id')
        ->leftJoin('categories','product_category.category_id','categories.id')
        ->select('products.product_id','product_name','product_image',
                'product_description','product_price','product_information',
                'product_category.category_id','categories.category_name',
                'pro_sale.sale_id','sales.sale_percent')
        ->where('products.product_id', $id)->first();
        $categories = DB::table('categories')->get();

        return view('admin.product.update',
    ['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        //
        
    $product = DB::table('products')->where('product_id', $product_id)->first();

    
    if ($request->hasFile('product_image')) {
        
        $filename = $request->file('product_image')->store('products', 'public');
        
        
        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }
    } else {
        
        $filename = $product->product_image;
    }

    
    DB::table('products')->where('product_id', $product_id)->update([
        'product_image' => $filename,
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_description' => $request->product_description,
        'product_information' => $request->product_information,
    ]);

    
    $data = [
        'category_id' => $request->category_id,
        'product_id' => $product_id
    ];
    $this->pros->updatePro($data);

    return redirect()->route('ad-product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
    }
}
