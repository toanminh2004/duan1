<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function addCart(Request $request)
    {
        $bill = DB::table('billes')
            ->leftJoin('status_bill', 'status_bill.bill_id', 'billes.id')
            ->where('status_bill.status_id', '!=', '1')
            ->where('status_bill.status_id', '!=', '2')
            ->where('status_bill.status_id', '!=', '3')
            ->where('status_bill.status_id', '!=', '4')
            ->where('status_bill.status_id', '!=', '5')
            ->where('status_bill.status_id', '!=', '6')
            ->where('billes.cart_id', $request->cart_id)
            ->select('billes.id')
            ->first();

        if ($bill) {
            $billId = $bill->id;
        } else {
            $billId = DB::table('billes')
                ->insertGetId([
                    'cart_id' => $request->cart_id,
                    'name' => Auth::user()->name,
                    'phone' => Auth::user()->phone,
                    'address' => Auth::user()->address,
                    'email' => Auth::user()->email

                ]);
        }

        return redirect()->route('bill.home', $billId);
    }



    public function bill($id)
    {

        $products = DB::table('products')
            ->leftJoin('pro_sale', 'products.product_id', 'pro_sale.product_id')
            ->leftJoin('sales', 'pro_sale.sale_id', 'sales.sale_id')
            ->leftJoin('product_category', 'products.product_id', 'product_category.product_id')
            ->leftJoin('categories', 'product_category.category_id', 'categories.id')
            ->leftJoin('cart_pro', 'cart_pro.product_id', 'products.product_id')
            ->leftJoin('billes', 'billes.cart_id', 'cart_pro.cart_id')
            ->select(
                'products.product_id',
                'product_name',
                'product_image',
                'cart_pro.quantity',
                'product_description',
                'product_price',
                'product_information',
                'billes.id',
                'product_category.category_id',
                'categories.category_name',
                'pro_sale.sale_id',
                'sales.sale_percent'
            )
            ->where('billes.id', $id)
            ->get();

        $carts = DB::table('carts')
            ->leftJoin('cart_pro', 'cart_pro.cart_id', 'carts.cart_id')
            ->leftJoin('billes', 'billes.cart_id', 'cart_pro.cart_id')
            ->leftJoin('products', 'products.product_id', 'cart_pro.product_id')
            ->leftJoin('pro_sale', 'pro_sale.product_id', 'products.product_id')
            ->leftJoin('sales', 'sales.sale_id', 'pro_sale.sale_id')
            ->select(
                'carts.cart_id',
                'products.product_price',
                'cart_pro.quantity',
                'billes.id',
                'sales.sale_percent'
            )
            ->where('billes.id', $id)
            ->get();

        $bill = DB::table('billes')
            ->leftJoin('carts', 'billes.cart_id', 'carts.cart_id')
            ->leftJoin('users', 'users.id', 'carts.account_id')
            ->leftJoin('cart_pro', 'cart_pro.cart_id', 'carts.cart_id')
            ->leftJoin('products', 'products.product_id', 'cart_pro.product_id')
            ->leftJoin('product_category', 'products.product_id', 'product_category.product_id')
            ->leftJoin('categories', 'categories.id', 'product_category.category_id')
            ->select(
                'carts.cart_id',
                'users.name',
                'users.phone',
                'users.email',
                'users.address',
                'products.product_name',
                'products.product_price',
                'cart_pro.quantity',
                'products.product_id',
                'categories.category_name',
                'billes.id'
            )
            ->where('billes.id', $id)
            ->first();

        return view(
            'client.checkOut',
            ['bill' => $bill, 'products' => $products, 'carts' => $carts]
        );
    }

    public function pay(Request $request)
    {
        $userId = Auth::user()->id;

        if ($request->name) {
            $name = $request->name;
        } else {
            $name = Auth::user()->name;
        }

        if ($request->phone) {
            $phone = $request->phone;
        } else {
            $phone = Auth::user()->phone;
        }

        if ($request->address) {
            $address = $request->address;
        } else {
            $address = Auth::user()->address;
        }

        if ($request->email) {
            $email = $request->email;
        } else {
            $email = Auth::user()->email;
        }

        DB::table('billes')
            ->where('id', $request->id)
            ->update([
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'email' => $email
            ]);

        $proData = DB::table('billes')
            ->leftJoin('status_bill', 'status_bill.bill_id', 'billes.id')
            ->leftJoin('carts', 'carts.cart_id', 'billes.cart_id')
            ->leftJoin('cart_pro', 'cart_pro.cart_id', 'carts.cart_id')
            ->leftJoin('products', 'products.product_id', 'cart_pro.product_id')
            ->select(
                'products.product_id',
                'products.product_price',
                'cart_pro.quantity',
                'billes.id',
                'carts.cart_id',
                'status_bill.status_id'
            )
            ->where('billes.id', $request->id)
            ->get();

        foreach ($proData as $pro) {
            DB::table('bill_extra')->insert([
                'bill_id' => $request->id,
                'product_id' => $pro->product_id,
                'quantity' => $pro->quantity,
            ]);
        }

        $status = DB::table('status_bill')
            ->where('status_bill.bill_id', $request->id)
            ->first();

        if (!$status) {
            DB::table('status_bill')
                ->insert([
                    'bill_id' => $request->id,
                    'status_id' => '1'
                ]);
        }

        foreach ($proData as $pro) {
            DB::table('cart_pro')
                ->where('product_id', $pro->product_id)
                ->where('cart_id', $pro->cart_id)
                ->delete();
        }

        return redirect()->route('allOrder', $userId);
    }

    public function allOrder($id)
    {

        $billes = DB::table('billes')
            ->leftJoin('status_bill', 'status_bill.bill_id', 'billes.id')
            ->leftJoin('status_of_bill', 'status_of_bill.id', 'status_bill.status_id')
            ->leftJoin('carts', 'carts.cart_id', 'billes.cart_id')
            ->leftJoin('users', 'users.id', 'carts.account_id')
            ->select(
                'billes.id',
                'status_of_bill.id as status_id',
                'status_of_bill.name as status_name',
                'billes.name','billes.phone','billes.address'
            )
            ->where('users.id', $id)
            ->orderBy('status_bill.status_id')
            ->get();

        $pros = DB::table('products')
            ->leftJoin('pro_sale', 'products.product_id', 'pro_sale.product_id')
            ->leftJoin('sales', 'pro_sale.sale_id', 'sales.sale_id')
            ->leftJoin('bill_extra', 'bill_extra.product_id', 'products.product_id')
            ->leftJoin('billes', 'billes.id', 'bill_extra.bill_id')
            ->leftJoin('carts', 'carts.cart_id', 'billes.cart_id')
            ->leftJoin('users', 'users.id', 'carts.account_id')
            ->leftJoin('status_bill', 'status_bill.bill_id', 'billes.id')
            ->leftJoin('status_of_bill', 'status_of_bill.id', 'status_bill.status_id')
            ->select(
                'product_name',
                'product_price',
                'status_of_bill.name',
                'billes.id as bill_id',
                'bill_extra.quantity',
                'sales.sale_percent'
            )
            ->where('users.id', $id)
            ->get();

        return view(
            'client.allOrder',
            ['id' => $id, 'products' => $pros, 'billes' => $billes]
        );
    }

    public function cancelBill(Request $request)
    {
        DB::table('status_bill')
            ->where('bill_id', $request->id)
            ->update([
                'status_id' => 5,
            ]);

        return redirect()->back();
    }
}
