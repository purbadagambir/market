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


Route::get('/', '\App\Http\Livewire\Dashboard\index');
//Route::get('/', 'TesController@index');

//Product
Route::get('/product', '\App\Http\Livewire\Product\index');

//Menu
Route::get('/sistem-menu', '\App\Http\Livewire\Menu\index');