<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Dashboard',
            'toko'  => 'Market 001'
        ];
        return view('dashboard.dashboard', compact('data'));
    }

    public function tes()
    {
        $data_product = DB::table('product_to_store')
                            ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                            ->where('product_to_store.store_id', 5)
                            ->where('products.p_code', 8998866602921)
                            ->get();
        return $data_product;
    }
}
