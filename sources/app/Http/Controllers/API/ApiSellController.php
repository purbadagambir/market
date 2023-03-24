<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ApiSellController extends Controller
{
    public function sell_list(Request $request)
    {
        $query = DB::table('selling_info')
                    ->join('customers', 'selling_info.customer_mobile', '=', 'customers.customer_mobile')
                    ->whereDate('selling_info.created_at', now())
                    ->where('selling_info.store_id', $request->store_id)
                    ->select('selling_info.info_id', 'selling_info.invoice_id', 'selling_info.created_at', 'selling_info.payment_status', 'customers.customer_name')
                    ->orderBy('selling_info.created_at', 'desc');
    
        $sell_list = $query->paginate($request['table']['perPage'], ['*'], 'page', $request['table']['pageSelect']);

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
                ], 200);
        }
    }
}
