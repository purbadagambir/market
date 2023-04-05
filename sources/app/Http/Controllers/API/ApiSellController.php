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

    public function sell_item(Request $request)
    {
        $sell_item = DB::table('selling_item')
                    ->join('units', 'selling_item.sell_unit_id', '=', 'units.unit_id')
                    ->where('invoice_id', $request->invoice_number)
                    ->select(DB::raw('FLOOR(item_price) AS item_price, FLOOR(item_quantity) AS item_quantity, selling_item.item_name, units.unit_name'))
                    ->get();

        $sell_price = DB::table('selling_price')
                    ->join('selling_info', 'selling_price.invoice_id', '=', 'selling_info.invoice_id')
                    ->join('payments', 'selling_price.invoice_id', '=', 'payments.invoice_id')
                    ->join('pmethods', 'payments.pmethod_id', '=', 'pmethods.pmethod_id')
                    ->join('users', 'payments.created_by', '=', 'users.id')
                    ->where('selling_price.invoice_id', $request->invoice_number)
                    ->select(DB::raw('FLOOR(selling_price.subtotal) AS subtotal, 
                                    FLOOR(selling_price.discount_amount) AS discount_amount, 
                                    FLOOR(selling_price.order_tax) AS order_tax, 
                                    FLOOR(selling_price.shipping_amount) AS shipping_amount, 
                                    FLOOR(selling_price.others_charge) AS other_charge, 
                                    FLOOR(selling_price.previous_due) AS previous_due,
                                    FLOOR(selling_price.prev_due_paid) AS previous_due_paid,
                                    FLOOR(selling_price.payable_amount) AS payable_amount, 
                                    FLOOR(selling_price.discount_amount) AS discount_amount,
                                    FLOOR(selling_price.interest_amount) AS interest_amount,
                                    FLOOR(selling_price.due) AS due, pmethods.name AS p_name, 
                                    FLOOR(payments.amount) AS amount, selling_info.total_items,
                                    pmethods.created_at, users.username'))
                    ->first();
        
        $data = [
            'item' => $sell_item,
            'price' => $sell_price
        ];

        if(empty($sell_item) or empty($sell_price)){
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
