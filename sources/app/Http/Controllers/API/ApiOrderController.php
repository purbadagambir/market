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

        $data_product = DB::table('product_to_store')
                ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                ->join('units as unit_small', 'products.unit_id', '=', 'unit_small.unit_id')
                ->join('units as unit_medium', 'products.unit_id_medium', '=', 'unit_medium.unit_id')
                ->join('units as unit_large', 'products.unit_id_large', '=', 'unit_large.unit_id')
                ->select('products.p_id', 'products.p_code', 'products.p_name',
                        'unit_small.unit_id as unit_small_id',
                        'unit_small.unit_name AS unit_small_name',
                        'unit_medium.unit_id as unit_medium_id',
                        'unit_medium.unit_name AS unit_medium_name',
                        'unit_large.unit_id as unit_large_id',
                        'unit_large.unit_name AS unit_large_name', 
                        )
                ->where('product_to_store.store_id', 5)
                ->limit(8)
                ->get();

        return response([
                'data'      => $data_product,
                'message'  => 'Success'
                ], 200);
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

    public function product_info(Request $request)
    {
        $data_product = ProductToStoreModel::with('product')->where('store_id', 5)
                                                            ->where('product_id', $request->p_id)
                                                            ->get();

        return  ProductToStoreResource::collection($data_product);
    }
    
}
