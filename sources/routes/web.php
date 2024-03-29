<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function() {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@store')->name('login');
    
});

Route::middleware('auth')->group(function() {
    //SELECT STORE
    Route::get('/select_store', 'LoginController@select_store')->name('select-store');
    Route::post('/set_store', 'LoginController@set_store')->name('set_store');
});

Route::middleware(['auth', 'store'])->group(function() {

    //DASHBOARD
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard-member', 'DashboardController@dashboard_member')->name('dashboard-member');
    Route::get('/monitoring', 'DashboardController@monitoring')->name('monitoring');
    Route::get('/tes', 'DashboardController@tes');


    //SELL
    Route::get('/sell-list', 'SellController@index')->name('sell');
    Route::get('/return-list', 'SellController@return_list')->name('return');
    Route::get('/sell-log', 'SellController@sell_log')->name('sell-log');

    //PRODUK
    Route::get('/produk-list', 'productController@index')->name('product');
    Route::get('/produk-unit', 'UnitController@index')->name('unit');
    Route::get('/produk-box', 'BoxController@index')->name('box');
    Route::get('/produk-category', 'CategoryController@index')->name('category');
    Route::get('/produk-brand', 'BrandController@index')->name('brand');

    //SISTEM
    Route::get('/sistem-menu', 'MenuController@index')->name('menu');
    Route::get('/group-setting-menu', 'MenuController@group_menu')->name('group_menu');

    Route::get('/sistem-curency', 'CurencyController@index')->name('curency');

    Route::get('/sistem-persentase-poin', 'PoinController@index')->name('persentese-poin');

    Route::get('/sistem-store', 'StoreController@index')->name('store');

    //PEMBELIAN
    Route::get('/purchase-list', 'PurchaseController@index')->name('purchase');

    //TRANSFER
    Route::get('/transfer-list', 'TransferController@index')->name('transfer');

    //TRANSFER
    Route::get('/supplier-list', 'SupplierController@index')->name('supplier');

    //MEMBER
    Route::get('/member-list', 'MemberController@index')->name('member');

    //EXPENSE
    Route::get('/expense', 'ExpenseController@index')->name('expense');
    Route::get('/expense-category', 'ExpenseController@category')->name('expense-category');
    Route::get('/expense-monthwise', 'ExpenseController@monthwise')->name('expense-monthwise');

    //POS
    Route::get('/pos', 'OrderController@index')->name('pos');
    Route::get('/invoice', 'OrderController@print');
    Route::get('/struk', 'OrderController@struk');

    //LOGOUT
    Route::post('/logout', 'LoginController@logout')->name('logout');
});