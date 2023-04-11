<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use App\Models\ReturnItem as ReturnItemModel;
use DB;

class ApiPurchaseController extends Controller
{
    public function purchase_list(Request $request)
    {
        $query = DB::table('purchase_info')
                    ->join('suppliers', 'purchase_info.sup_id', '=', 'suppliers.sup_id')
                    ->join('users', 'purchase_info.created_by', '=', 'users.id')
                    ->join('purchase_payments', 'purchase_info.invoice_id', '=', 'purchase_payments.invoice_id')
                    ->where('purchase_info.store_id', $request->store_id)
                    ->where('purchase_info.status', 1)
                    ->whereDate('purchase_info.created_at', date('Y-m-d'))
                    ->select(DB::raw('FLOOR(purchase_payments.amount) AS amount, FLOOR(purchase_payments.total_paid) AS total_paid,
                                        purchase_info.info_id, purchase_info.invoice_id, purchase_info.created_at,
                                        purchase_info.payment_status, suppliers.sup_name, users.username AS created_by'))
                    ->orderBy('purchase_info.created_at', 'desc');
    
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
}
