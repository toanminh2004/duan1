<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function signUp () {
        return view('authen.signup');
    }

    public function postSignup(Request $request) {
        $objUser = new User();
        $request->merge(['password'=>Hash::make($request->password)]);
        $res = $objUser->signup($request->all());

        if($res) {
            Cart::create(['account_id'=>$res->id]);
            return redirect()->back()->with('success','Đăng kí thành công');
        } else {
            return redirect()->back()->with('error','Đăng kí không thành công');
        }
    }

    public function signIn () {
        return view('authen.signin');
    }

    public function postSignin(Request $request) {
        if(Auth::attempt(['email'=>$request->email,
        'password'=>$request->password])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error','Sai thông tin tài khoản');
        }
    }

    public function signOut() {
        Auth::logout();
        return redirect()->route('signin');
    }

    public function forgotPass() {
        return view('authen.forgotpass');
    }

    public function updatePass($id) {
        $user = User::find($id);
        return view('authen.updatepass',['user'=>$user]);
    }

    public function postUpdatePass(Request $request) {
        DB::table('users')
        ->where('id',$request->id)
        ->update(['password' => bcrypt($request->password)]);

        return redirect()->route('signin')->with('success','Cập nhật mật khẩu thành công');
    }
}
