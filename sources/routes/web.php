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


//DASHBOARD
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index');


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