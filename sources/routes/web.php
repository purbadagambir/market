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
    Route::get('/monitoring', 'DashboardController@monitoring')->name('monitoring');
    Route::get('/tes', 'DashboardController@tes');


    //SELL
    Route::get('/sell-list', 'SellController@index')->name('sell-list');
    Route::get('/return-list', 'SellController@return_list')->name('return-list');
    Route::get('/sell-log', 'SellController@sell_log')->name('sell-log');

    //PRODUK
    Route::get('/produk-list', 'productController@index')->name('product');
    Route::get('/produk-unit', 'UnitController@index')->name('unit');
    Route::get('/produk-box', 'BoxController@index')->name('box');
    Route::get('/produk-category', 'CategoryController@index')->name('category');
    Route::get('/produk-brand', 'BrandController@index')->name('brand');

    //SISTEM
    Route::get('/sistem-menu', 'MenuController@index')->name('menu');
    Route::get('/sistem-curency', 'CurencyController@index')->name('curency');

    //PEMBELIAN
    Route::get('/pembelian', 'PurchaseController@index')->name('pembelian');

    //MUTASI
    Route::get('/mutasi', 'TransferController@index')->name('mutasi');

    //MEMBER
    Route::get('/member', 'MemberController@index')->name('member');

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