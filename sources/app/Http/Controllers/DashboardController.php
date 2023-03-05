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
            'toko'  => session('store')->name
        ];
        return view('dashboard.dashboard', compact('data'));
    }

    public function tes()
    {
        echo session('store');
    }
}
