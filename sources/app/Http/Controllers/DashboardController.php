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

    public function tes()
    {   
        $periode = [
            'start'     => date('2022-05-20'),
            'end'       => date('Y-m-d')
        ];
        return total_expense(5, $periode);
    }
}
