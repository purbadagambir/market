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
            'toko'  => session('store')->name
        ];
        return view('dashboard.dashboard', compact('data'));
    }

    public function tes()
    {
        $last_id = count(SellingInfoModel::where('store_id', session('store')->store_id)->get()) + 1;

        
        $bilangan=1234; // Nilai Proses
        $fzeropadded = sprintf("%08d", $bilangan);

        return $fzeropadded;
    }
}
