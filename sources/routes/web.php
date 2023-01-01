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

<<<<<<< HEAD
//DASHBOARD
Route::get('/', 'MenuController@index')->name('menu');
=======
Route::get('/', 'MenuController@index')->name('dashboard');
>>>>>>> 8fe3c96b63622bfeee332f54a2bb1a825faeb61d

//PRODUK
Route::get('/produk-list', 'productController@index')->name('product');
Route::get('/produk-unit', 'UnitController@index')->name('unit');
Route::get('/produk-box', 'BoxController@index')->name('box');
Route::get('/produk-category', 'CategoryController@index')->name('category');
Route::get('/produk-brand', 'BrandController@index')->name('brand');

//SISTEM
Route::get('/sistem-menu', 'MenuController@index')->name('menu');
Route::get('/sistem-curency', 'CurencyController@index')->name('curency');