<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use App\Models\ReturnItem as ReturnItemModel;
use DB;

class ApiSupplierController extends Controller
{
    public function supplier_list(Request $request)
    {
        $query =    DB::table('supplier_to_store')
                    ->join('suppliers', 'supplier_to_store.sup_id', '=', 'suppliers.sup_id')
                    ->join('product_to_store', 'supplier_to_store.sup_id', '=', 'product_to_store.sup_id')
                    ->select(DB::raw('
                                        suppliers.sup_id, suppliers.sup_name, suppliers.sup_mobile, 
                                        suppliers.created_at, supplier_to_store.status,
                                        FLOOR(count(product_to_store.sup_id)) as jumlah_product
                                    '))
                    ->where('supplier_to_store.store_id', $request->store_id)
                    ->groupBy('suppliers.sup_id', 'suppliers.sup_name', 'suppliers.sup_mobile', 'suppliers.created_at', 'supplier_to_store.status');

        $supplier_list = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($supplier_list->count() > 0){

            foreach($supplier_list as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $supplier_list->currentPage(),
                "from" => $supplier_list->firstitem(),
                "last_page" => $supplier_list->lastPage(),
                "path" => $supplier_list->path(),
                "per_page" => $supplier_list->perPage(),
                "to" => $supplier_list->lastitem(),
                "total" => $supplier_list->total()
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
