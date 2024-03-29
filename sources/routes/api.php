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

//DASHBOARD
Route::post('/get-monitoring', 'API\ApiDashboardController@monitoring');
Route::post('/get-data-member', 'API\ApiDashboardController@dashboard_member');

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

//PRODUCT-BOX
Route::post('/get-box', 'API\ApiBoxController@index');
Route::post('/create-box', 'API\ApiBoxController@store');
Route::post('/show-box', 'API\ApiBoxController@show');
Route::post('/update-box', 'API\ApiBoxController@update');
Route::post('/delete-box', 'API\ApiBoxController@delete');

//PRODUCT-BRAND
Route::post('/get-brand', 'API\ApiBrandController@index');
Route::post('/create-brand', 'API\ApiBrandController@store');
Route::post('/show-brand', 'API\ApiBrandController@show');
Route::post('/update-brand', 'API\ApiBrandController@update');
Route::post('/delete-brand', 'API\ApiBrandController@delete');

//SISTEM-MENU
Route::post('/get-menu', 'API\ApiMenuController@index');
Route::post('/create-menu', 'API\ApiMenuController@store');
Route::post('/show-menu', 'API\ApiMenuController@show');
Route::post('/update-menu', 'API\ApiMenuController@update');
Route::post('/delete-menu', 'API\ApiMenuController@delete');

//SISTEM-POIN
Route::post('/get-poin', 'API\ApiPoinController@index');
Route::post('/create-poin', 'API\ApiPoinController@store');
Route::post('/show-poin', 'API\ApiPoinController@show');
Route::post('/update-poin', 'API\ApiPoinController@update');
Route::post('/delete-poin', 'API\ApiPoinController@delete');

//SISTEM-POIN
Route::post('/get-store', 'API\ApiStoreController@index');
Route::post('/create-store', 'API\ApiStoreController@store');
Route::post('/show-store', 'API\ApiStoreController@show');
Route::post('/update-store', 'API\ApiStoreController@update');
Route::post('/delete-store', 'API\ApiStoreController@delete');

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

//ORDER
Route::post('/get-product-list', 'API\ApiOrderController@product_list');
Route::post('/get-product-search', 'API\ApiOrderController@product_search');
Route::post('/get-product-code', 'API\ApiOrderController@product_code');
Route::post('/get-product-info', 'API\ApiOrderController@product_info');
Route::post('/add-orders', 'API\ApiOrderController@add_orders');
Route::post('/search-member', 'API\ApiOrderController@search_member');

//SELL_LIST
Route::post('/get-sell-list', 'API\ApiSellController@sell_list');
Route::post('/get-sell-info', 'API\ApiSellController@sell_info');
Route::post('/get-sell-item', 'API\ApiSellController@sell_item');
Route::post('/return-sell-item', 'API\ApiSellController@return_item');
Route::post('/update-sell-info', 'API\ApiSellController@update_sell_info');

//PURCHASE
Route::post('/get-purchase-list', 'API\ApiPurchaseController@purchase_list');

//TRANSFER
Route::post('/get-transfer-list', 'API\ApiTransferController@transfer_list');

//SUPPLIER
Route::post('/get-supplier-list', 'API\ApiSupplierController@supplier_list');

//MEMBER
Route::post('/get-member-list', 'API\ApiMemberController@member_list');



