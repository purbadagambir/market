<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer as CustomerModel;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $pmethod = DB::table('pmethod_to_store')
                        ->join('pmethods', 'pmethod_to_store.ppmethod_id', '=', 'pmethods.pmethod_id')
                        ->where('pmethod_to_store.store_id', 5)
                        ->get();
        $data = [
            'page'  => 'POS',
            'toko'  => 'Market 001',
            'members' => CustomerModel::limit(10)->get(),
            'pmethod' => $pmethod,
        ];
        return view('orders.order', compact('data'));
    }
}
