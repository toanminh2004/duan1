<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $proId = $request->product_id;
            $quantity = $request->quantity;

            $existingCart = DB::table('cart_pro')
                ->join('carts', 'cart_pro.cart_id', 'carts.cart_id')
                ->where('carts.account_id', $userId)
                ->where('cart_pro.product_id', $proId)
                ->first();

            $cart = DB::table('carts')
                ->select('carts.cart_id')
                ->where('account_id', $userId)
                ->first();

            // Kiểm tra nếu $cart không null và lấy cart_id từ đối tượng
            $cartId = $cart ? $cart->cart_id : null;


            if ($existingCart) {
                DB::table('cart_pro')
                    ->where('cart_id', $existingCart->cart_id)
                    ->where('product_id', $proId)
                    ->update(['quantity' => $existingCart->quantity + $quantity]);
            } else {

                DB::table('cart_pro')->insert([
                    'cart_id' => $cartId,
                    'product_id' => $proId,
                    'quantity' => $quantity,
                ]);
            }
            return redirect()->route('cart',Auth::user()->id)->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        } else {
            return redirect()->route('signin')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng này');
        }
    }

    public function updateCart(Request $request)
    {
        $userId = Auth::user()->id;
        $proId = $request->product_id;
        $quantity = $request->quantity;
        $cartId = $request->cart_id;

        $cart = DB::table('cart_pro')
        ->leftJoin('carts','carts.cart_id','cart_pro.cart_id')
        ->where('carts.account_id',$userId)
        ->where('cart_pro.cart_id', $cartId)
        ->where('product_id', $proId)
        ->first();
        if($cart) {
            DB::table('cart_pro')
            ->leftJoin('carts','carts.cart_id','cart_pro.cart_id')
            ->where('carts.account_id',$userId)
            ->where('cart_pro.cart_id', $cartId)
            ->where('product_id', $proId)
            ->update(['quantity' => $quantity]);
        }

        return redirect()->back()->with('success','Cập nhật thành công số lượng sản phẩm');
    }

    public function deleteCart(Request $request) {
        DB::table('cart_pro')
        ->where('product_id',$request->product_id)
        ->where('cart_id',$request->cart_id)
        ->delete();

        return redirect()->back()->with('success','Sản phẩm đã được xóa khỏi giỏ hàng');
    }
}
