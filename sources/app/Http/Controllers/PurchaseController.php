<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Catatan Penjualan',
            'toko'  => 'Market 001'
        ];
        return view('purchase.purchase', compact('data'));
    }
}
