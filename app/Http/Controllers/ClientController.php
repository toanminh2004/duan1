<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public $pros;
    public $cats;

    public $carts;

    public function __construct()
    {
        $this->pros = new Product();
        $this->cats = new Category();
        $this->carts = new Cart();
    }
    //
    public function home()
    {

        $listProSale = $this->pros->getProSale();
        $listPro = $this->pros->getAllProHome();
        $listCat = $this->cats->getCatHome();
        $sale = $this->pros->getAllSale();

        return view(
            'client.home',
            ['products' => $listPro, 'categories' => $listCat, 'sales' => $sale, 'prosales' => $listProSale]
        );
    }

    public function category()
    {

        $listPro = $this->pros->getAllPro();
        $listCat = $this->cats->getAllCat();
        $sale = $this->pros->getAllSale();

        return view(
            'client.category',
            ['products' => $listPro, 'categories' => $listCat, 'sales' => $sale]
        );
    }

    public function cart($id)
    {


        $cart = $this->carts->getCart($id);

        $listProCart = DB::table('cart_pro')
            ->leftJoin('carts', 'cart_pro.cart_id', 'carts.cart_id')
            ->leftJoin('users', 'users.id', 'carts.account_id')
            ->leftJoin('products', 'products.product_id', 'cart_pro.product_id')
            ->leftJoin('pro_sale','pro_sale.product_id','products.product_id')
            ->leftJoin('sales','sales.sale_id','pro_sale.sale_id')
            ->leftJoin('product_category', 'products.product_id', 'product_category.product_id')
            ->leftJoin('categories', 'categories.id', 'product_category.category_id')
            ->select(
                'carts.cart_id',
                'users.name',
                'products.product_image',
                'products.product_name',
                'products.product_price',
                'cart_pro.quantity',
                'products.product_id',
                'categories.category_name',
                'sales.sale_percent'
            )
            ->where('users.id', $id)
            ->get();



        return view('client.cart', ['cart' => $cart,'products'=>$listProCart]);
    }
    public function product()
    {
        return view('client.product');
    }

    public function payment()
    {
        return view('client.payment');
    }

    public function baohanh()
    {
        return view('client.warranty');
    }

    public function accDetail()
    {

        $id = Auth::user()->id;

        $acc = User::where('id', $id);

        return view('client.accountDetail', ['acc' => $acc]);
    }

    public function updateAcc(Request $request) {
        $id = Auth::user()->id;

        $data = DB::table('users')
        ->where('id',$id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        if($data) {
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        }
    }
}
