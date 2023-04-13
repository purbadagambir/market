<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductResource;
use App\Models\Product as ProductModel;
use DB;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('product_to_store')
                ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                ->join('units as unit_small', 'products.unit_id', '=', 'unit_small.unit_id')
                ->join('units as unit_medium', 'products.unit_id_medium', '=', 'unit_medium.unit_id')
                ->join('units as unit_large', 'products.unit_id_large', '=', 'unit_large.unit_id')
                ->join('selling_item', 'products.p_id', '=', 'selling_item.item_id')
                ->join('boxes', 'product_to_store.box_id', '=', 'boxes.box_id')
                ->join('suppliers', 'product_to_store.sup_id', '=', 'suppliers.sup_id')
                ->select(DB::raw('products.p_id, products.p_code, products.p_name,
                                FLOOR(product_to_store.quantity_in_stock) AS stock, 
                                FLOOR(product_to_store.purchase_price) AS purchase_price,
                                FLOOR(product_to_store.sell_price_large) AS sell_price_large,
                                FLOOR(product_to_store.sell_price_medium) AS sell_price_medium,
                                FLOOR(product_to_store.sell_price) AS sell_price_small,
                                unit_small.unit_id as unit_small_id,
                                unit_small.unit_name AS unit_small_name,
                                products.vol_unit_small,
                                unit_medium.unit_id as unit_medium_id,
                                unit_medium.unit_name AS unit_medium_name,
                                products.vol_unit_medium,
                                unit_large.unit_id as unit_large_id,
                                unit_large.unit_name AS unit_large_name,
                                products.vol_unit_large,
                                boxes.box_name AS rak, suppliers.sup_name'
                        ))
                ->groupBy(
                            'products.p_id', 'products.p_code', 'products.p_name',
                            'product_to_store.quantity_in_stock', 'product_to_store.purchase_price',
                            'product_to_store.sell_price_large', 'product_to_store.sell_price_medium',
                            'product_to_store.sell_price', 'unit_small.unit_id', 'unit_small.unit_name',
                            'products.vol_unit_small', 'unit_medium.unit_id', 'unit_medium.unit_name',
                            'products.vol_unit_medium', 'unit_large.unit_id', 'unit_large.unit_name',
                            'products.vol_unit_large', 'boxes.box_name', 'suppliers.sup_name'
                            )
                ->where($request->column, 'LIKE', '%' . $request->keyword . '%');
    
        $sell_list = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($sell_list->count() > 0){

            foreach($sell_list as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $sell_list->currentPage(),
                "from" => $sell_list->firstitem(),
                "last_page" => $sell_list->lastPage(),
                "path" => $sell_list->path(),
                "per_page" => $sell_list->perPage(),
                "to" => $sell_list->lastitem(),
                "total" => $sell_list->total()
            ];
    
            $response = [
                'data'  => $data,
                'meta'  => $meta,
                'message' => 'success'
            ];

            return response($response, 200);

        }else{
            return response([
                'data'      => null,
                'message'  => 'Data not found'
                ], 201);
        }
    }
}

