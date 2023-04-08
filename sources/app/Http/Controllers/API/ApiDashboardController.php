<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ApiDashboardController extends Controller
{
    public function monitoring(Request $request)
    {
        if($request->start == null || $request->end == null ){
            $periode = null;
        }else{
            $periode = [
                'start'     => date('2022-05-20'),
                'end'       => date('Y-m-d')
            ];
        }

        $stores = DB::table('stores')->get();

        foreach($stores as $store)
        {
            $data[] = [
                'store_name'        => $store->name,
                'store_address'     => $store->address,
                'total_sales'       => number_format(intval(total_sales($store->store_id, $periode))),
                'total_expense'     => number_format(intval(total_expense($store->store_id, $periode))),
                'total_point'       => number_format(intval(total_point($store->store_id, $periode))),
                'total_balance'     => number_format(intval(total_balance($store->store_id, $periode)))
            ];
        }

        $response = [
            'data'  => $data,
            'message' => 'success'
        ];

        return response($response, 200);
    }
}
