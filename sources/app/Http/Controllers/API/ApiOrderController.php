<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use DB;


class ApiOrderController extends Controller
{
    public function product_list(Request $request)
    {
        $data_product = ProductToStoreModel::with('product')->where('store_id', 5)->limit(8)->get();

        return  ProductToStoreResource::collection($data_product);
    }

    public function product_code(Request $request)
    {
        $data_product = DB::table('product_to_store')
                            ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                            ->where('product_to_store.store_id', 5)
                            ->where('products.p_code', $request->code)
                            ->get();
        return $data_product;
    }
}
