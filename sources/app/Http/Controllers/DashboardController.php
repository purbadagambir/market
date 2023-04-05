<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use App\Models\SellingInfo as SellingInfoModel;
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
        

        $sell_item = DB::table('selling_item')
        ->join('units', 'selling_item.sell_unit_id', '=', 'units.unit_id')
        ->where('invoice_id', '52023/00000215')
        ->select(DB::raw('FLOOR(item_price) AS item_price, FLOOR(item_quantity) AS item_quantity, selling_item.item_name'))
        ->get();
        
        return $sell_item;
    }
}
