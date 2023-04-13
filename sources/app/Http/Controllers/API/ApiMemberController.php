<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use App\Models\ReturnItem as ReturnItemModel;
use DB;

class ApiMemberController extends Controller
{
    public function member_list(Request $request)
    {
        $query =    DB::table('customers')
                    ->join('customers AS parent', 'customers.customer_id', '=', 'parent.customer_id')
                    ->select(
                        'customers.customer_name', 'customers.customer_mobile', 
                        'customers.customer_address', 'customers.customer_city', 
                        'parent.customer_name AS sponsor', 
                        'customers.customer_email', 'customers.created_at')
                    ->orderBy('customers.created_at', 'desc');

        $member_list = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($member_list->count() > 0){

            foreach($member_list as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $member_list->currentPage(),
                "from" => $member_list->firstitem(),
                "last_page" => $member_list->lastPage(),
                "path" => $member_list->path(),
                "per_page" => $member_list->perPage(),
                "to" => $member_list->lastitem(),
                "total" => $member_list->total()
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
