<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $data = [
            'page'  => 'Dashboard',
            'toko'  => session('store')->name,
        ];

        return view('dashboard.dashboard', compact('data'));

    }

    public function monitoring()
    {
        

        $store = DB::table('stores')->get();

        $data = [
            'page'  => 'Monitoring',
            'toko'  => session('store')->name,
            'stores'  => $store
        ];

        return view('dashboard.monitoring', compact('data'));
    }

    public function dashboard_member()
    {
        $data_member = DB::table('customers')->get();
        $data_member_aktif = DB::table('customers')->where('status_frontend', 1)->get();
        
        $query_point = DB::table('customers')
                    ->select(DB::raw("FLOOR(SUM(total_points)) as total_point"))
                    ->get();

        $query_balance = DB::table('customer_transactions')
                    ->where('notes', 'Points To Credits')
                    ->select(DB::raw("FLOOR(SUM(amount)) as total_balance"))
                    ->get();
        
        foreach($query_point as $point){
            $data_point = $point->total_point;
        }

        foreach($query_balance as $balance){
            $data_balance = $balance->total_balance;
        }

        $data_member_point = DB::table('customers')->offset(0)->limit(20)->orderBy('total_points', 'DESC')->get();
        $data_activity_member = DB::table('customer_transactions')
                                    ->join('customers', 'customer_transactions.customer_id', '=', 'customers.customer_id')
                                    ->select('customers.customer_name','customers.customer_mobile', 'customer_transactions.customer_id', DB::raw('count(*) as total'))
                                    ->groupBy('customers.customer_name', 'customers.customer_mobile', 'customer_transactions.customer_id')
                                    ->orderBy('total', 'DESC')
                                    ->offset(0)->limit(20)
                                    ->get();


        $data = [
            'page'                  => 'Dashboard Member',
            'toko'                  => session('store')->name,
            'total_member'          => number_format(intval(count($data_member))),
            'total_member_aktif'    => number_format(intval(count($data_member_aktif))),
            'total_point'           => number_format(intval($data_point)),
            'total_balance'         => number_format(intval($data_balance)),
            'data_member'           => $data_member_point,
            'data_activity_member'  => $data_activity_member,
        ];

        return view('dashboard.dashboard_member', compact('data'));
    }

    public function tes()
    {   
        $periode = [
            'start'     => date('y-m-01'),
            'end'       => date('y-m-d')
        ];

        $data_activity_member = DB::table('customer_transactions')
        ->join('customers', 'customer_transactions.customer_id', '=', 'customers.customer_id')
        ->whereBetween('customer_transactions.created_at',  [$periode['start'], $periode['end']])
        ->select('customers.customer_name','customers.customer_mobile', 'customer_transactions.customer_id', DB::raw('count(*) as total'))
        ->groupBy('customers.customer_name', 'customers.customer_mobile', 'customer_transactions.customer_id')
        ->orderBy('total', 'DESC')
        ->offset(0)->limit(20)
        ->get();

        return $data_activity_member;
    }
}
