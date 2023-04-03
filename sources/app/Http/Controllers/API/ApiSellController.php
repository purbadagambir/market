<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use DB;

class ApiSellController extends Controller
{
    public function sell_list(Request $request)
    {
        $query = DB::table('selling_info')
                    ->join('customers', 'selling_info.customer_id', '=', 'customers.customer_id')
                    ->whereDate('selling_info.created_at', now())
                    ->where('selling_info.store_id', $request->store_id)
                    ->where('selling_info.status', 1)
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
                ], 201);
        }
    }

    public function sell_info(Request $request)
    {
        $data = DB::table('selling_info')
                    ->join('selling_price', 'selling_info.invoice_id', '=', 'selling_price.invoice_id')
                    ->join('customers', 'selling_info.customer_id', '=', 'customers.customer_id')
                    ->where('selling_info.invoice_id', $request->invoice_number)
                    ->select(
                                'selling_info.invoice_id', 'selling_info.customer_mobile',
                                'selling_info.invoice_note', 'selling_info.status',
                                'selling_price.subtotal', 'selling_price.discount_amount',
                                'customers.customer_name', 'selling_price.payable_amount',
                                'selling_price.paid_amount', 'selling_price.due'
                            )
                    ->first();

        if(empty($data)){
            return response([
                'data'      => null,
                'message'  => 'Data not found'
            ], 201);
        }else{
            return response([
                'data'      => $data,
                'message'  => 'success'
            ], 200);
        }
        
    }

    public function update_sell_info(Request $request)
    {
        $data_update = [
            "customer_mobile" => '0'.$request->customer_mobile,
            "invoice_note" => $request->invoice_note,
            "status" => $request->status
        ];

        $query = SellingInfoModel::where('invoice_id', $request->invoice_id)->update($data_update);

        if($query)
        {
            return response([
                'message'  => 'Success'
            ], 200);
        } 
        else 
        {
            return response([
                'message'  => 'Failed to update'
            ], 201);
        }
    }
}
