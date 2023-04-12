<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use App\Models\ReturnItem as ReturnItemModel;
use DB;

class ApiTransferController extends Controller
{
    public function transfer_list(Request $request)
    {
        $query =    DB::table('bank_transaction_info')
                        ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id')
                        ->join('bank_accounts', 'bank_transaction_info.account_id', 'bank_accounts.id')
                        ->where('bank_transaction_info.store_id', $request->store_id)
                        ->select(DB::raw('FLOOR(sum(bank_transaction_price.amount)) as amount,
                                        bank_transaction_info.transaction_type, bank_accounts.account_name,
                                        bank_transaction_info.invoice_id, bank_transaction_info.created_at
                                        '))
                        ->orderBy('bank_transaction_info.created_at', 'desc')
                        ->groupBY('bank_transaction_info.transaction_type', 
                                    'bank_accounts.account_name',
                                    'bank_transaction_info.invoice_id',
                                    'bank_transaction_info.created_at');
    
        $transfer_list = $query->paginate($request['table']['perPage'], ['*'], 'page', $request['table']['pageSelect']);

        if($transfer_list->count() > 0){

            foreach($transfer_list as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $transfer_list->currentPage(),
                "from" => $transfer_list->firstitem(),
                "last_page" => $transfer_list->lastPage(),
                "path" => $transfer_list->path(),
                "per_page" => $transfer_list->perPage(),
                "to" => $transfer_list->lastitem(),
                "total" => $transfer_list->total()
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
