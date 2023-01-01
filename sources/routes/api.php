<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//PRODUCT-LIST
Route::post('/get-product', 'API\ApiProductController@index');
Route::post('/create-product', 'API\ApiProductController@store');
Route::post('/show-product', 'API\ApiProductController@show');
Route::post('/update-product', 'API\ApiProductController@update');
Route::post('/delete-product', 'API\ApiProductController@delete');

//PRODUCT-CATEGORY
Route::post('/get-category', 'API\ApiCategoryController@index');
Route::post('/create-category', 'API\ApiCategoryController@store');
Route::post('/show-category', 'API\ApiCategoryController@show');
Route::post('/update-category', 'API\ApiCategoryController@update');
Route::post('/delete-category', 'API\ApiCategoryController@delete');

//PRODUCT-CATEGORY
Route::post('/get-box', 'API\ApiBoxController@index');
Route::post('/create-box', 'API\ApiBoxController@store');
Route::post('/show-box', 'API\ApiBoxController@show');
Route::post('/update-box', 'API\ApiBoxController@update');
Route::post('/delete-box', 'API\ApiBoxController@delete');

//PRODUCT-CATEGORY
Route::post('/get-brand', 'API\ApiBrandController@index');
Route::post('/create-brand', 'API\ApiBrandController@store');
Route::post('/show-brand', 'API\ApiBrandController@show');
Route::post('/update-brand', 'API\ApiBrandController@update');
Route::post('/delete-brand', 'API\ApiBrandController@delete');

//MENU
Route::post('/get-menu', 'API\ApiMenuController@index');
Route::post('/create-menu', 'API\ApiMenuController@store');
Route::post('/show-menu', 'API\ApiMenuController@show');
Route::post('/update-menu', 'API\ApiMenuController@update');
Route::post('/delete-menu', 'API\ApiMenuController@delete');

//MENU
Route::post('/get-curency', 'API\ApiCurencyController@index');
Route::post('/create-curency', 'API\ApiCurencyController@store');
Route::post('/show-curency', 'API\ApiCurencyController@show');
Route::post('/update-curency', 'API\ApiCurencyController@update');
Route::post('/delete-curency', 'API\ApiCurencyController@delete');

//UNIT
Route::post('/get-unit', 'API\ApiUnitController@index');
Route::post('/create-unit', 'API\ApiUnitController@store');
Route::post('/show-unit', 'API\ApiUnitController@show');
Route::post('/update-unit', 'API\ApiUnitController@update');
Route::post('/delete-unit', 'API\ApiUnitController@delete');



