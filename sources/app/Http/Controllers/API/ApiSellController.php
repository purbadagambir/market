<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use App\Models\ReturnItem as ReturnItemModel;
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
                    ->select(DB::raw('FLOOR(item_price) AS item_price, 
                                        FLOOR(item_quantity) AS item_quantity, 
                                        selling_item.item_name, units.unit_name,
                                        selling_item.id'))
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

    public function return_item(Request $request)
    {
        DB::beginTransaction();
            try {
                $store_id = $request->store_id;
                $date = date('ymd');
                $last_id = count(ReturnsModel::where('store_id', $store_id)->get()) + 1;
                $reference_no = 'R'.$date.sprintf("%04d", $last_id);
                $selling_item = DB::table('selling_item')->whereIn('id', $request->item_id)->get();

                $return = [
                    'store_id'              => $store_id,
                    'reference_no'          => $store_id,
                    'invoice_id'            => $store_id,
                    'purchase_invoice_id'   => $store_id,
                    'customer_id'           => $store_id,
                    'note'                  => $store_id,
                    'total_item'            => $store_id,
                    'total_quantity'        => $store_id,     
                    'subtotal'              => $store_id,
                    'total_amount'          => $store_id,
                    'item_tax'              => $store_id,
                    'cgst'                  => $store_id,
                    'sgst'                  => $store_id,
                    'igst'                  => $store_id,
                    'total_purchase_price'  => $store_id,
                    'profit'                => $store_id,
                    'attachment'            => $store_id,
                    'created_by'            => $store_id,
                    'created_at'            => $store_id,
                    'updated_at'            => $store_id,
                    'total_points'          => $store_id
                ];

                ReturnsModel::insert($return_item);

                foreach($selling_item as $item) {
                    $return_item[] = [
                        'store_id'              => $item->store_id,      
                        'reference_no'          => $reference_no,
                        'item_id'               => $item->item_id,
                        'item_name'             => $item->item_name,
                        'item_quantity'         => $item->item_item_quantity,
                        'item_purchase_price'   => $item->item_purchase_price,       
                        'item_price'            => $item->item_price,    
                        'item_tax'              => $item->item_tax, 
                        'cgst'                  => $item->cgst, 
                        'sgst'                  => $item->sgst,  
                        'igst'                  => $item->igst, 
                        'item_total'            => $item->item_total,      
                        'created_at'            => now(),       
                        'return_unit_id'        => $item->sell_unit_id,        
                        'return_vol_unit'       => $item->sell_vol_unit,      
                        'return_qty_conversi'   => $item->sell_qty_conversi
                    ];

                    ReturnItemModel::insert($return_item);
                }

                

                

        DB::commit();

        return response([
            'data'      => $invoice_number,
            'message'  => 'Success'
            ], 200);

        } catch (Exception $e) {
            DB::rollback();
            return response([
                'data'      => 0,
                'message'  => 'Error'
                ], 201); 
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
