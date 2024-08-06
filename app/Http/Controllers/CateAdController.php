<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CateAdController extends Controller
{
    public $cats;

    public function __construct(){
        $this->cats = new Category();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listCate = $this->cats->getAllCat();

        return view('admin.category.list',['categories'=>$listCate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataInsert = DB::table('categories')->insert([
            'category_name' => $request->category_name
        ]);
        return redirect()->route('ad-category.index');
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
        $cate = $this->cats->getCatById($id);

        return view('admin.category.update',
        ['cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        DB::table('categories')->where('id',$id)->update([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('ad-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('ad-category.index')
        ->with('success', 'Sản phẩm đã được xóa thành công');
    }
}
