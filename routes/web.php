<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillAdController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CateAdController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProAdController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleAdController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(ClientController::class)
    ->group(function () {
        Route::get('/',  'home')->name('home');
        Route::get('categories',  'category');
        Route::get('cart/{id}',  'cart')->name('cart');
        Route::get('acc-detail',  'accDetail')->name('acc.detail');
        Route::get('payment',  'payment');
        Route::get('warranty',  'baohanh');
        Route::post('update-acc', 'updateAcc')->name('acc.update');
    });

Route::controller(AdminController::class)
    ->group(function () {
        Route::get('ad',  'index')->name('ad')->middleware('admin');
        Route::delete(
            'ad-product/delete/{product_id}',
            'deletePro'
        )->name('ad-product.delete')->middleware('admin');
        Route::delete(
            'ad-sale/delete/{sale_id}',
            'deleteSale'
        )->name('ad-sale.delete')->middleware('admin');

        Route::get('users', 'listAcc')->name('users')->middleware('admin');
        Route::post('update-user','updateRoleAcc')->name('updateRoleAcc')->middleware('admin');
    });

Route::resource('product', ProductController::class);

Route::resource('category', CateController::class);

Route::resource('ad-product', ProAdController::class)->middleware('admin');

Route::resource('ad-category', CateAdController::class)->middleware('admin');

Route::resource('ad-sale', SaleAdController::class)->middleware('admin');

Route::resource('ad-bill', BillAdController::class)->middleware('admin');

Route::controller(AccountController::class)
    ->group(function () {
        Route::get('signup', 'signUp')->name('signup');
        Route::post('signup', 'postSignup')->name('postSignup');
        Route::get('signin', 'signIn')->name('signin');
        Route::post('signin', 'postSignin')->name('postSignin');
        Route::post('signout', 'signOut')->name('postSignout');
        Route::get('forgot-password', 'forgotPass')->name('forgotPass');
        Route::get('update-pass/{id}', 'updatePass')->name('updatePass');
        Route::post('postUpdatePass', 'postUpdatePass')->name('postUpdatePass');
    });

Route::controller(CartController::class)
    ->group(function () {
        Route::post('/cart/add', 'addToCart')->name('cart.add');
        Route::post('/cart/update', 'updateCart')->name('cart.update');
        Route::post('/cart/delete', 'deleteCart')->name('cart.delete');
    });

Route::controller(BillController::class)
    ->group(function () {
        Route::post('add', 'addCart')->name('bill.add');
        Route::get('bill/{id}', 'bill')->name('bill.home');
        Route::post('pay', 'pay')->name('pay');
        Route::get('total-order/{id}', 'allOrder')->name('allOrder');
        Route::post('cancel-bill' , 'cancelBill')->name('bill.cancel');
    });

Route::post('/send-email-reset-pass', [EmailController::class, 'sendEmailResetPass'])->name('sendEmailResetPass');

Route::post('/send-email-bill', [EmailController::class, 'sendEmailBill'])->name('sendEmailBill');