<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CateController extends Controller
{
    public $pros;
    public $cats;

    public function __construct(){
        $this->pros = new Product();
        $this->cats = new Category();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
        $listPro = $this->pros->getAllPro();
        $cat = $this->cats->getCatById($id);
        $sale = $this->pros->getAllSale();

        return view('client.categoryDetail',
        ['products'=>$listPro,'category'=>$cat,'sales'=>$sale]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
