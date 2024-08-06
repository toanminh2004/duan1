<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::user()->id;
        $role = DB::table('acc_role')
        ->where('account_id',$userId)
        ->first();
        if(Auth::check() && $role->role_id == 1) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'Tài khoản của bạn không đủ quyền');
        }
    }
}
