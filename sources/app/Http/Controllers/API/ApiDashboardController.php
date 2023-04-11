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
            $periode = [
                'start'     => date('y-m-d'),
                'end'       => date('y-m-d')
            ];
        }else{
            $periode = [
                'start'     => $request->start,
                'end'       => $request->end
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
                'total_balance'     => number_format(intval(total_balance($store->store_id, $periode))),
                'image'             => $store->logo
            ];
        }

        $response = [
            'data'  => $data,
            'message' => 'success'
        ];

        return response($response, 200);
    }

    public function dashboard_member(Request $request)
    {   

        if($request->start == null || $request->end == null ){
            $periode = [
                'start'     => date('2020-m-01'),
                'end'       => date('y-m-d')
            ];
        }else{
            $periode = [
                'start'     => $request->start,
                'end'       => $request->end
            ];
        }

        $data = DB::table('customer_transactions')
                    ->join('customers', 'customer_transactions.customer_id', '=', 'customers.customer_id')
                    ->whereBetween('customer_transactions.created_at',  [$periode['start'], $periode['end']])
                    ->select('customers.customer_name','customers.customer_mobile', 'customer_transactions.customer_id', DB::raw('count(*) as total'))
                    ->groupBy('customers.customer_name', 'customers.customer_mobile', 'customer_transactions.customer_id')
                    ->orderBy('total', 'DESC')
                    ->offset(0)->limit(20)
                    ->get();
        
        $response = [
            'data'  => $data,
            'message' => 'success'
        ];

        return response($response, 200);
    }
}
