<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function deletePro($product_id) {
        $product = Product::where('product_id',$product_id)->firstOrFail();
        $product->delete();

        return redirect()->route('ad-product.index')
        ->with('success', 'Sản phẩm đã được xóa thành công');
    }

    public function deleteSale($sale_id) {
        $sale = Sale::where('sale_id',$sale_id)->firstOrFail();
        $sale->delete();

        return redirect()->route('ad-sale.index')
        ->with('success', 'Sản phẩm đã được xóa thành công');
    }

    public function listAcc () {
        $users = DB::table('users')
        ->leftJoin('acc_role','acc_role.account_id','users.id')
        ->leftJoin('roles','roles.id','acc_role.role_id')
        ->select('users.id as user_id','users.phone','users.name','users.email'
        ,'users.address','roles.role_name','roles.role_description')
        ->get();
        return view('admin.user.list',['users'=>$users]);
    }

    public function updateRoleAcc (Request $request) {
        DB::table('acc_role')
        ->where('account_id',$request->user_id)
        ->update(['role_id'=>$request->role_id]);
        return redirect()->back()->with('success','Thao tác thành công');
    }
}
